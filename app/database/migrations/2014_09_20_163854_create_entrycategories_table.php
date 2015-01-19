<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrycategoriesTable extends Migration
{

    public function up()
    {
        Schema::create( 'entrycategories', function ( Blueprint $table ) {

            $table->increments( 'id' );

            $table->string( 'code' );
            $table->string( 'name' );
            $table->softDeletes();

            $table->timestamps();
        } );
    }

    public function down()
    {
        Schema::drop( 'entrycategories' );
    }

}