<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrydatabasesTable extends Migration
{

    public function up()
    {
        Schema::create( 'entrydatabases', function ( Blueprint $table ) {

            $table->increments( 'id' );

            $table->string( 'name' );
            $table->string( 'type' );
            $table->boolean( 'connect' );
            $table->string( 'username' );
            $table->string( 'password' );
            $table->string( 'port' );
            $table->softDeletes();

            $table->timestamps();
        } );
    }

    public function down()
    {
        Schema::drop( 'entrystates' );
    }

}