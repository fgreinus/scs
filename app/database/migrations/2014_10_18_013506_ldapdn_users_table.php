<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LdapdnUsersTable extends Migration
{

    public function up()
    {
        Schema::table( 'users', function ( Blueprint $table ) {

            $table->string( 'ldapdn' );

        } );
    }

    public function down()
    {
        Schema::table( 'users', function ( Blueprint $table ) {

            $table->dropColumn( 'ldapdn' );

        } );
    }

}