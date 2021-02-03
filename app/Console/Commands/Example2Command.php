<?php

namespace App\Console\Commands;

use App\Contracts\InternetArchive;
use App\Models\Book;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class Example2Command extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'command:name2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param InternetArchive $internetArchive
     * @return void
     * @throws GuzzleException
     */
    public function handle(InternetArchive $internetArchive)
    {
        // Get all the books available in the database.
        $books = Book::select('id', 'thumbnail', 'url_iarchive')->get();

        $this->warn("Fetching book thumbnails. Please, wait...");

        // Show a progress bar starting at 0 and ending with the total number of
        // books to be processed.
        $this->output->progressStart($books->count());

        foreach ($books->chunk(15) as $chunk) {
            foreach ($chunk as $book) {
                // Request the book thumbnail only if its value in the database is
                // currently empty. In case the thumbnail column contains any value, the
                // current iteration is discarded and continues to the next one.
                if (!empty($book->thumbnail)) {
                    $this->output->progressAdvance();
                    continue;
                }

                $book->thumbnail = $internetArchive->fetchDetails($book)->thumbnail();
                $book->save();

                // Move one step forward in the progress bar to show the user the status of
                // the operation.
                $this->output->progressAdvance();
            }

            // Delay the execution of the next loop, in this way we avoid sending many
            // requests in a short period of time.
            sleep($this->option('sleep'));
        }

        // Fill in the progress bar to show the user that the operation has been
        // completed.
        $this->output->progressFinish();

        $this->info('Completed. All book thumbnails has been fetched successfully');
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['sleep', null, InputOption::VALUE_OPTIONAL, 'Sleep interval in seconds', 30],
        ];
    }
}
