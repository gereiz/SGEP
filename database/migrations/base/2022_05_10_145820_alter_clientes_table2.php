<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterClientesTable2 extends Migration
{public function up()
    {
        Schema::table('clientes', function($table) {
            $table->string('cpf_cnpj')->after('nome_fantasia');
            $table->string('nro_insc')->after('cpf_cnpj');


        });
    }


    public function down()
    {
        Schema::table('clientes', function($table) {
            $table->dropColumn('cpf_cnpj');
            $table->dropColumn('nro_insc');
        });
    }
}
