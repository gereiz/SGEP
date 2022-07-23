<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoTableOutdoors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('outdoors', function (Blueprint $table) {
        $table->string('tipo') // Nome da coluna
                    ->after('identificacao'); // Ordenado após a coluna "identificacao"
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outdoors', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });
    }
}
