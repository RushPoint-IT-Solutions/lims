<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEbooksUniqueIndex extends Migration
{
    public function up(): void
    {
        Schema::table('ebooks', function (Blueprint $table) {
            $table->dropUnique(['isbn']);
            $table->unique(['isbn', 'deleted_at']);
        });
    }

    public function down(): void
    {
        Schema::table('ebooks', function (Blueprint $table) {
            $table->dropUnique(['isbn', 'deleted_at']);
            $table->unique('isbn');
        });
    }
}
