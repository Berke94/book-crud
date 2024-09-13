<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueToIsbnNumberInBooksTable extends Migration
{

    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('isbn_number')->unique()->change();
        });
    }


    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropUnique(['isbn_number']);
        });
    }
}
