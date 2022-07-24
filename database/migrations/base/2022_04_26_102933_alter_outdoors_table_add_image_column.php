<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOutdoorsTableAddImageColumn extends Migration
{

    public function up()
    {
        Schema::table('outdoors', function($table) {
            $table->text('image_url')->after('longitude');
        });
    }


    public function down()
    {
        Schema::table('outdoors', function($table) {
            $table->dropColumn('image_url');
        });
    }
}
