<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBranchesUniqueIndex extends Migration
{
    public function up(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropUnique(['branch_name']);
            $table->unique(['branch_name', 'deleted_at']);
        });
    }

    public function down(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropUnique(['branch_name', 'deleted_at']);
            $table->unique('branch_name');
        });
    }
}
