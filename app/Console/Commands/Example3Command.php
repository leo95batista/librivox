<?php

namespace App\Console\Commands;

use App\Contracts\LibriVox;
use App\Models\Book;
use Illuminate\Console\Command;

class Example3Command extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'command:name3';

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
     * @param LibriVox $librivox
     * @return void
     */
    public function handle(LibriVox $librivox)
    {
        // Get all the books available in the database.
        $books = Book::select('id', 'url_rss')->get();

        $this->warn("Fetching audio tracks. Please, be patient...");

        // Show a progress bar starting at 0 and ending with the total number of
        // books to be processed.
        $this->output->progressStart($books->count());

        foreach ($books as $book) {
            //
        }

        // Fill in the progress bar to show the user that the operation has been
        // completed.
        $this->output->progressFinish();

        $this->info('Completed. All audio tracks has been fetched successfully');
    }
}
