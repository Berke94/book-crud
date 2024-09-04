<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->get(); // Yazar bilgilerini de yükle
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::all(); // Yazarları listeleyin
        return view('books.create', compact('authors'));
    }

    public function store(Request $request)
    {
        // Formdan gelen verileri doğrula
        $request->validate([
            'book_name' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'description' => 'required|string',
            'isbn_number' => 'required|string|max:255',
            'number_of_pages' => 'required|integer',
        ]);

        // Yazarın veritabanında olup olmadığını kontrol et
        $author = Author::firstOrCreate(
            ['name' => $request->author_name]
        );

        // Kitap kaydı oluştur
        Book::create([
            'book_name' => $request->book_name,
            'author_id' => $author->id,
            'description' => $request->description,
            'isbn_number' => $request->isbn_number,
            'number_of_pages' => $request->number_of_pages,
        ]);

        return redirect()->route('books.index')->with('success', 'Kitap başarıyla eklendi.');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all(); // Yazarları listeleyin
        return view('books.edit', compact('book', 'authors'));
    }

    public function update(Request $request, $id)
    {
        // Kitap verisini ID'ye göre bul
        $book = Book::findOrFail($id);

        // Verileri doğrula ve güncelle
        $request->validate([
            'book_name' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'description' => 'required|string',
            'isbn_number' => 'required|string|max:255',
            'number_of_pages' => 'required|integer|min:1',
        ]);

        // Kitap bilgilerini güncelle
        $book->update([
            'book_name' => $request->input('book_name'),
            'author_id' => $request->input('author_id'),
            'description' => $request->input('description'),
            'isbn_number' => $request->input('isbn_number'),
            'number_of_pages' => $request->input('number_of_pages'),
        ]);

        return redirect()->route('books.index')->with('success', 'Kitap başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Kitap başarıyla silindi.');
    }
}
