<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutdoorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outdoors', function (Blueprint $table) {
            $table->id();
            $table->string('identificacao');
            $table->string('localizacao');
            $table->string('posicao');
            $table->string('dimensao');
            $table->string('dimensao_lona');
            $table->string('ponto_referencia');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outdoors');
    }
}
