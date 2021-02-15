<?php

namespace App\Console\Commands;

use App\Contracts\LibriVox;
use App\Models\Book;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class FetchSectionsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'fetch:sections';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch book sections';

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
     * @param LibriVox $librivox
     * @return void
     * @throws GuzzleException
     */
    public function handle(LibriVox $librivox)
    {
        $sleep = $this->option('sleep');

        // Get all the books available in the database.
        $books = Book::select('id', 'url_rss')->get();

        $this->warn("Fetching book sections. Please, wait...");

        // Show a progress bar starting at 0 and ending with the total number of
        // books to be processed.
        $this->output->progressStart($books->count());

        foreach ($books as $book) {
            foreach ($librivox->fetchRSS($book)->channel->item as $item) {
                $book->sections()->firstOrCreate([
                    'title' => $item->title,
                    'audio' => $item->enclosure['url'],
                    'duration' => $item->duration,
                    'file_type' => $item->enclosure['type']
                ]);
            }

            // Move one step forward in the progress bar to show the user the status of
            // the operation.
            $this->output->progressAdvance();

            // Delay the execution of the next loop, in this way we avoid sending many
            // requests in a short period of time.
            sleep($sleep);
        }

        // Fill in the progress bar to show the user that the operation has been
        // completed.
        $this->output->progressFinish();

        $this->info('Completed. All book sections has been fetched successfully');
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
