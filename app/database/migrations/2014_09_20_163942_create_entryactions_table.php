<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntryactionsTable extends Migration
{

    public function up()
    {
        Schema::create( 'entryactions', function ( Blueprint $table ) {

            $table->increments( 'id' );

            $table->string( 'code' );
            $table->string( 'name' );
            $table->string( 'color' );
            $table->string( 'icon' );
            $table->softDeletes();

            $table->timestamps();
        } );
    }

    public function down()
    {
        Schema::drop( 'entryactions' );
    }

}