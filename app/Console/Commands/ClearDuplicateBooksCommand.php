<?php

namespace App\Console\Commands;

use App\Models\Book;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearDuplicateBooksCommand extends Command
{
    protected $signature = 'books:clear-duplicates';


    protected $description = 'Clear duplicate books based on ISBN number';


    public function handle()
    {

        $duplicateIds = Book::query()
            ->whereIn('isbn_number',
                Book::query()
                    ->select('isbn_number')
                    ->groupBy('isbn_number')
                    ->havingRaw('COUNT(*) > 1')
            )
            ->whereNotIn('id',
                Book::query()
                    ->selectRaw('MIN(id)')
                    ->groupBy('isbn_number')
            )
           // ->whereRaw('id NOT IN (SELECT MIN(id) FROM books GROUP BY isbn_number)')
            ->pluck('id');

            Book::query()
                ->whereIn('id', $duplicateIds)
                ->delete();

        $this->info('Duplicate books have been cleared.');

        return 0;
    }
}
