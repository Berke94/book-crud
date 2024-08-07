<?php

use App\Models\Book;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $book = 1;
        $bookDetail = Book::find($book);
    dd($bookDetail);

});

