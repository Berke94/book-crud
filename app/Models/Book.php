<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
class Book extends Model
{
    use HasFactory;

    protected $guarded = [

    ];
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    public function bookstores()
    {
        return $this->belongsToMany(Bookstore::class, 'book_bookstore');
    }
}

