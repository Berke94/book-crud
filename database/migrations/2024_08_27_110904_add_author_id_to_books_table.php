<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthorIdToBooksTable extends Migration
{
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id')->after('id'); // author_id sütunu ekleniyor
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade'); // foreign key tanımlanıyor
        });
    }

    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['author_id']); // foreign key kaldırılıyor
            $table->dropColumn('author_id'); // author_id sütunu kaldırılıyor
        });
    }
}


