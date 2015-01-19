<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ColorForRoles extends Migration
{

    public function up()
    {
        Schema::table( 'roles', function ( Blueprint $table ) {

            $table->string('color');

        } );
    }

    public function down()
    {
        Schema::table('roles', function ( Blueprint $table ) {

            $table->dropColumn('color');

        } );
    }

}