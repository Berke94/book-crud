<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bookstore;

class BookstoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookstores = [
            ['name' => 'D&R'],
            ['name' => 'Kitapyurdu'],
            ['name' => 'Idefix'],
        ];

        foreach ($bookstores as $store) {
            Bookstore::create($store);
        }
    }
}
