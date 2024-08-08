<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearDuplicateBooksCommand extends Command
{
    protected $signature = 'books:clear-duplicates';


    protected $description = 'Clear duplicate books based on ISBN number';


    public function handle()
    {
        $duplicateIDs = DB::table('books')
            ->select('id')
            ->whereIn('isbn_number', function ($query) {
                $query->select('isbn_number')
                    ->from('books')
                    ->groupBy('isbn_number')
                    ->havingRaw('COUNT(*) > 1');
            })
            ->whereRaw('id NOT IN (SELECT MIN(id) FROM books GROUP BY isbn_number)')
            ->pluck('id');

        // Delete duplicate entries
        DB::table('books')->whereIn('id', $duplicateIDs)->delete();

        $this->info('Duplicate books have been cleared.');

        return 0;
    }
}
