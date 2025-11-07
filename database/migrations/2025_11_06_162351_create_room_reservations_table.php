<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reservation_id');
            $table->string('room_name'); 
            $table->unsignedBigInteger('reserved_by'); 
            $table->dateTime('reserved_from');
            $table->dateTime('reserved_to');
            $table->string('purpose');
            $table->text('other_remarks')->nullable();
            $table->string('status');
            $table->text('remarks')->nullable();
            $table->string('approved_by');
            $table->string('approved_date');
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
        Schema::dropIfExists('room_reservations');
    }
}
