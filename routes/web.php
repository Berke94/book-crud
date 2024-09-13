<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;


// Anasayfa (kitap listeleme)
Route::get('/books', [BookController::class, 'index'])->name('books.index');

// Kitap ekleme
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');

// Kitap düzenleme
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');

// Kitap silme
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

// Otomatik tamamlama için route
Route::get('/authors/search', [AuthorController::class, 'search'])->name('authors.search');

// Yazar onaylama sayfasına erişim
Route::middleware(['auth'])->group(function () {
    Route::get('authors/approval', [AuthorController::class, 'approvalPage'])->name('authors.approval');

    // Yazar onaylama işlemi
    Route::post('authors/{author}/approve', [AuthorController::class, 'approve'])->name('authors.approve');
    Route::delete('authors/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');

});

Route::get('/book-store', [BookController::class, 'index'])->name('book.store');




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    // Add other book-related routes here
});

require __DIR__.'/auth.php';


