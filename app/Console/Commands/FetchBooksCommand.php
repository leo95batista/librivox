<?php

namespace App\Console\Commands;

use App\Contracts\LibriVox;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Translator;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Symfony\Component\Console\Input\InputOption;

class FetchBooksCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'fetch:books';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch books';

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
     */
    public function handle(LibriVox $librivox)
    {
        $start = $this->option('start');
        $batch = $this->option('batch');

        do {
            $this->warn("Trying to make a request to LibriVox API");
            // Get the books available from LibriVox. The server returns by default
            // only 50 records in each query if no limits are defined.
            $books = $librivox->audiobooks()->offset($start)->limit($batch)->extended(true)->fetch();

            if (!empty($books)) {
                // Get the total number of books returned by the server's response.
                $total = $books->count();

                $this->warn("The server returned a response with {$total} books");
                $this->warn("Mapping database. Please wait, this may take a while...");

                // Show a progress bar starting at 0 and ending with the total number of
                // books to be processed.
                $this->output->progressStart($total);

                foreach ($books as $book) {
                    // Check that the book does not exist in our database by verifying its
                    // properties, except for the properties author, genre, sections and
                    // translators. If the book doesn't exist, then we create it.
                    $bookReference = Book::firstOrCreate(Arr::except($book, [
                        'authors', 'genres', 'sections', 'translators'
                    ]));

                    // Associate the authors of the book.
                    if (is_array($book['authors']) && !empty($book['authors'])) {
                        foreach ($book['authors'] as $author) {
                            Author::firstOrCreate($author)->books()->syncWithoutDetaching($bookReference);
                        }
                    }

                    // Associate the genres of the book.
                    if (is_array($book['genres']) && !empty($book['genres'])) {
                        foreach ($book['genres'] as $genre) {
                            Genre::firstOrCreate($genre)->books()->syncWithoutDetaching($bookReference);
                        }
                    }

                    // Associate the book's translators.
                    if (is_array($book['translators']) && !empty($book['translators'])) {
                        foreach ($book['translators'] as $translator) {
                            Translator::firstOrCreate($translator)->books()->syncWithoutDetaching($bookReference);
                        }
                    }

                    // Move one step forward in the progress bar to show the user the status of
                    // the operation.
                    $this->output->progressAdvance();
                }

                $start += $batch;

                // Fill in the progress bar to show the user that the operation has been
                // completed.
                $this->output->progressFinish();

                $this->info("Batch completed. Sleeping queue for {$this->option('sleep')} seconds");
                $this->newLine();

                // Delay the execution of the next loop, in this way we avoid sending many
                // requests in a short period of time.
                sleep($this->option('sleep'));
            }

            // Continue running the loop until an empty response is encountered
            // or the server returns an error. Any HTTP response code greater
            // than 200 will be treated as an error.
        } while (!empty($books));

        $this->info('Completed. The database has been successfully updated.');
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
            ['batch', null, InputOption::VALUE_OPTIONAL, 'Number of records in each iteration', 50],
            ['sleep', null, InputOption::VALUE_OPTIONAL, 'Sleep interval in seconds', 60],
        ];
    }
}
