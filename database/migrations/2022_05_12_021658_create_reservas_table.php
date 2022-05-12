<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('outdor_id');
            $table->unsignedBigInteger('bisemana_id');
            $table->text('observacao');

            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('outdor_id')->references('id')->on('outdoors');
            $table->foreign('bisemana_id')->references('id')->on('bisemanas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
