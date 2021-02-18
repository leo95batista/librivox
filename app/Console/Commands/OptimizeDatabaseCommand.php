<?php

namespace App\Console\Commands;

use App\Models\Book;
use Exception;
use Illuminate\Console\Command;

class OptimizeDatabaseCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'optimize:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run certain tests to try to optimize the database';

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
     * @return void
     * @throws Exception
     */
    public function handle()
    {
        $this->info('[INFO] Starting optimization tests');

        $this->step1();

        $this->info('[INFO] Done. All possible optimizations have been completed');
    }

    /**
     * Check that there are no books without associated audio sections.
     *
     * @throws Exception
     */
    public function step1()
    {
        $booksWithoutSections = [];

        $this->info('[INFO] Searching for books without associated audio sections');

        foreach (Book::all() as $book) {
            if (!$book->sections()->exists()) {
                $booksWithoutSections[] = $book;
            }
        }

        if (!empty($booksWithoutSections)) {
            // Get the amount of books without associated audio sections.
            $amount = count($booksWithoutSections);

            $this->warn("[WARN] {$amount} books have been found without associated audio sections");

            if ($this->confirm('Would you like to remove the books without associated audio sections?')) {
                $this->info('[INFO] Removing books that have no associated audio sections, please wait ...');

                // Show a progress bar starting at 0 and ending with the total number of
                // books to be processed.
                $this->output->progressStart($amount);

                foreach ($booksWithoutSections as $book) {
                    Book::findOrFail($book->id)->delete();

                    // Move one step forward in the progress bar to show the user the status of
                    // the operation.
                    $this->output->progressAdvance();
                }

                // Fill in the progress bar to show the user that the operation has been
                // completed.
                $this->output->progressFinish();

                $this->info("[INFO] {$amount} books have been removed from the database");
            }
        } else {
            $this->info('[INFO] Ok, all books have at least one associated audio section');
        }
    }
}
