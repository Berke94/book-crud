<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // Kitap listesini göster
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // Yeni bir kitap oluşturma formunu göster
    public function create()
    {
        return view('books.create');
    }

    // Yeni bir kitap kaydet
    public function store(Request $request)
    {
        $request->validate([
            'book' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'description' => 'nullable|text',
            'isbn_number' => 'nullable|string',
            'number_of_pages' => 'required|integer',
        ]);

        $book = new Book([
            'book' => $request->get('book'),
            'author_name' => $request->get('author_name'),
            'description' => $request->get('description'),
            'isbn_number' => $request->get('isbn_number'),
            'number_of_pages' => $request->get('number_of_pages'),
        ]);

        $book->save();

        return redirect('/books')->with('success', 'Kitap başarıyla eklendi!');
    }

    // Belirli bir kitabı göster
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    // Bir kitabı düzenleme formunu göster
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    // Bir kitabı güncelle
    public function update(Request $request, $id)
    {
        $request->validate([
            'book' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'description' => 'nullable|text',
            'isbn_number' => 'nullable|string',
            'number_of_pages' => 'required|integer',
        ]);

        $book = Book::findOrFail($id);
        $book->book = $request->get('book');
        $book->author_name = $request->get('author_name');
        $book->description = $request->get('description');
        $book->isbn_number = $request->get('isbn_number');
        $book->number_of_pages = $request->get('number_of_pages');
        $book->save();

        return redirect('/books')->with('success', 'Kitap başarıyla güncellendi!');
    }

    // Bir kitabı sil
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect('/books')->with('success', 'Kitap başarıyla silindi!');
    }
}
