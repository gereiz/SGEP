<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOutdoorsTableChangeAddressColumns extends Migration
{
    public function up()
    {
        Schema::table('outdoors', function($table) {
            $table->dropColumn('localizacao');
            $table->unsignedinteger('bairro_id')->after('identificacao');
            $table->string('logradouro')->after('bairro_id');
            $table->string('numero')->after('logradouro');
            $table->text('image_url')->nullable()->change();

            $table->foreign('bairro_id')->references('id')->on('bairros');
        });
    }


    public function down()
    {
        Schema::table('outdoors', function($table) {
            $table->string('localizacao')->after('identificacao');
            $table->dropForeign(['bairro_id']);
            $table->dropColumn('bairro_id');
            $table->dropColumn('logradouro');
            $table->dropColumn('numero');
            $table->text('image_url')->nullable(false)->change();
        });
    }
}
