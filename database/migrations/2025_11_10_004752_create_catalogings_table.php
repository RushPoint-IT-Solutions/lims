<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedBigInteger('framework_id'); 
            $table->unsignedBigInteger('type_id');
            $table->string('publisher')->nullable();
            $table->string('isbn');
            $table->string('publication_year')->nullable();
            $table->string('edition')->nullable();
            $table->string('ddc')->nullable();
            $table->unsignedBigInteger('rack_id')->nullable(); 
            $table->unsignedBigInteger('branch_id'); 
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogings');
    }
}
