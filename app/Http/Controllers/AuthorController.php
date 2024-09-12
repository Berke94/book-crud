<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;


class AuthorController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:authors,name',
        ]);

        $author = Author::create([
            'name' => $request->input('name'),
        ]);

        return response()->json($author); // JSON yanıt döndür
    }
    public function search(Request $request)
    {
        $query = $request->get('term');
        $authors = Author::where('name', 'LIKE', "%{$query}%")->get();

        $results = $authors->map(function ($author) {
            return [
                'id' => $author->id,
                'label' => $author->name
            ];
        });

        return response()->json($results);
    }

    // Onay sayfası
    public function approvalPage()
    {
        $authors = Author::where('approved', false)->get(); // Onay bekleyen yazarlar
        return view('authors.approval', compact('authors'));
    }

    // Yazar onaylama işlemi
    public function approve($id)
    {
        $author = Author::findOrFail($id);
        $author->update(['approved' => true]);

        return redirect()->route('authors.approval')->with('success', 'Yazar başarıyla onaylandı.');
    }
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->route('authors.approval')->with('success', 'Yazar başarıyla silindi.');
    }



}
