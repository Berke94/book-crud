<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }
    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'isbn_number' => 'required|string|size:17|unique:books,isbn_number', // ISBN 13 rakam ve formatlı olmalı
            'number_of_pages' => 'required|integer|min:1',
        ]);

        Book::create([
            'book_name' => $request->input('book_name'),
            'author' => $request->input('author'),
            'description' => $request->input('description'),
            'isbn_number' => $request->input('isbn_number'),
            'number_of_pages' => $request->input('number_of_pages'),
        ]);

        // Başarı mesajı ile index sayfasına yönlendir
        return redirect()->route('books.index')->with('success', 'Kitap başarıyla eklendi.');
    }


    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    /**
     * Kitap günceller.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Kitap verisini ID'ye göre bul
        $book = Book::findOrFail($id);

        // Verileri doğrula ve güncelle
        $request->validate([
            'book_name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'isbn_number' => 'required|string|size:17',
            'number_of_pages' => 'required|integer|min:1',
        ]);

        // Kitap bilgilerini güncelle
        $book->book_name = $request->input('book_name');
        $book->author = $request->input('author');
        $book->description = $request->input('description');
        $book->isbn_number = $request->input('isbn_number');
        $book->number_of_pages = $request->input('number_of_pages');
        $book->save();

        // Güncellenmiş kitapla birlikte index sayfasına yönlendir
        return redirect()->route('books.index')->with('success', 'Kitap başarıyla güncellendi.');
    }
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Kitap başarıyla silindi.');
    }
}
