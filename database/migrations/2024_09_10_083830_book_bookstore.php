<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('book_bookstore', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('cascade'); // Kitap ID'si
            $table->foreignId('bookstore_id')->constrained()->onDelete('cascade'); // Kitapçı ID'si
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('book_bookstore');
    }
};
