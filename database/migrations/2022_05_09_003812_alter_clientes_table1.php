<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterClientesTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Clientes', function($table) {
            $table->string('responsavel')->after('nome_fantasia');
            $table->string('tel_responsavel')->after('responsavel');
            $table->string('email_responsavel')->after('tel_responsavel');

        });
    }


    public function down()
    {
        Schema::table('clientes', function($table) {
            $table->dropColumn('responsavel');
            $table->dropColumn('tel_responsavel');
            $table->dropColumn('email_responsavel');
        });
    }
}
