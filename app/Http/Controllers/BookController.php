<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Bookstore;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index()
    {
        $books = Book::with('bookstores', 'author')->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::all(); // Yazarları listeleyin
        $bookstores = Bookstore::all();
        return view('books.create', compact('authors', 'bookstores'));
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
            'bookstores' => 'nullable|array',
            'bookstores.*' => 'exists:bookstores,id'
        ]);

        // Yazarın veritabanında olup olmadığını kontrol et
        $author = Author::firstOrCreate(
            ['name' => $request->author_name]
        );

        // Kitap kaydı oluştur
        $book = Book::create([
            'book_name' => $request->book_name,
            'author_id' => $author->id,
            'description' => $request->description,
            'isbn_number' => $request->isbn_number,
            'number_of_pages' => $request->number_of_pages,
        ]);
        $book->bookstores()->sync($request->bookstores);
        return redirect()->route('books.index')->with('success', 'Kitap başarıyla eklendi.');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all(); // Yazarları listeleyin
        $bookstores = Bookstore::all();
        return view('books.edit', compact('book', 'authors', 'bookstores'));


    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'book_name' => 'required|string|max:255',
            'author_name' => 'required|string|max:255', // Yazar adı doğrulaması
            'description' => 'required|string',
            'isbn_number' => 'required|string|max:255',
            'number_of_pages' => 'required|integer|min:1',
            'bookstores' => 'nullable|array',
            'bookstores.*' => 'exists:bookstores,id'
        ]);

        $book = Book::findOrFail($id);



        // Yazarın veritabanında olup olmadığını kontrol et veya yeni bir yazar oluştur
        $author = Author::firstOrCreate(
            ['name' => $request->author_name] // Yazar ismi üzerinden kontrol
        );

        // Kitap bilgilerini güncelle
        $book->update([
            'book_name' => $request->input('book_name'),
            'author_id' => $author->id, // Yazarın ID'si ile güncelleniyor
            'description' => $request->input('description'),
            'isbn_number' => $request->input('isbn_number'),
            'number_of_pages' => $request->input('number_of_pages'),
        ]);
        $book->bookstores()->sync($request->bookstores);
        return redirect()->route('books.index')->with('success', 'Kitap başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Kitap başarıyla silindi.');
    }
}
