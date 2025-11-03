<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTypesUniqueIndex extends Migration
{
    public function up(): void
    {
        Schema::table('types', function (Blueprint $table) {
            $table->dropUnique(['code']);
            $table->unique(['code', 'deleted_at']);
        });
    }

    public function down(): void
    {
        Schema::table('types', function (Blueprint $table) {
            $table->dropUnique(['code', 'deleted_at']);
            $table->unique('code');
        });
    }
}
