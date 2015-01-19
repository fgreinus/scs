<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropPasswordUsersTable extends Migration
{

    public function up()
    {
        Schema::table( 'users', function ( Blueprint $table ) {

            $table->dropColumn( 'password' );

        } );
    }

    public function down()
    {
        Schema::table( 'users', function ( Blueprint $table ) {

            $table->string( 'password', 64 );

        } );
    }

}