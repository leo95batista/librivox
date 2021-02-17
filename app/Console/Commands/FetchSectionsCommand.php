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
        // Here are stored the books for which the sections could not be obtained.
        $error = [];

        $start = $this->option('start');
        $sleep = $this->option('sleep');


        // Get all the books available in the database.
        $books = Book::select('id', 'title', 'url_rss', 'url_librivox')->get()->skip($start);

        $this->warn("Fetching book sections. Please, wait...");

        // Show a progress bar starting at 0 and ending with the total number of
        // books to be processed.
        $this->output->progressStart($books->count());

        foreach ($books as $book) {
            // Verify that LibriVox contains sections associated with the book,
            // if not, ignore the iteration and jump to the next one.
            if (empty($book->url_librivox)) {
                $error[] = [
                    'id' => $book->id,
                    'title' => $book->title
                ];

                // Book has no RSS address associate, jump to next book
                continue;
            }

            // Get the content of the RSS file.
            $rss = $librivox->fetchRSS($book);

            if (isset($rss->channel)) {
                foreach ($rss->channel->item as $item) {
                    $book->sections()->firstOrCreate([
                        'title' => $item->title,
                        'audio' => $item->enclosure['url'],
                        'duration' => $item->duration,
                        'file_type' => $item->enclosure['type']
                    ]);
                }
            } else {
                $error[] = [
                    'id' => $book->id,
                    'title' => $book->title
                ];
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

        if (!empty($error)) {
            $this->warn('Unable to get audio sections for the following books:');

            // Show books for which sections could not be obtained.
            $this->table(['ID', 'Book Title'], $error);
        }

        $this->info('Completed. Book sections has been fetched successfully');
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['start', null, InputOption::VALUE_OPTIONAL, 'Position from where the first iteration starts', 0],
            ['sleep', null, InputOption::VALUE_OPTIONAL, 'Sleep interval in seconds', 30],
        ];
    }
}
