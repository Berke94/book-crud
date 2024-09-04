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
        $term = $request->get('term');

        $authors = Author::where('name', 'LIKE', '%' . $term . '%')->get();

        return response()->json($authors->map(function ($author) {
            return [
                'id' => $author->id,
                'label' => $author->name
            ];
        }));
    }
}
