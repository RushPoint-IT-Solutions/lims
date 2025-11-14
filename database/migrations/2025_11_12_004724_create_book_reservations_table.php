<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reservation_id');
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('reserved_by'); 
            $table->date('reserved_date');
            $table->date('pickup_date')->nullabe();
            $table->string('status');
            $table->string('cancelled_by')->nullable();
            $table->string('cancelled_date')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('book_reservations');
    }
}
