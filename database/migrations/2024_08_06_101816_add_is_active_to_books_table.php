<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsActiveToBooksTable extends Migration
{

    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->boolean('is_active')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
}
