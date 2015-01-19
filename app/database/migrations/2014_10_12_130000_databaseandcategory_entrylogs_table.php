<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DatabaseandcategoryEntrylogsTable extends Migration
{

    public function up()
    {
        Schema::table( 'entrylogs', function ( Blueprint $table ) {

            $table->integer('database_id');
            $table->integer('category_id');

        } );
    }

    public function down()
    {
        Schema::table( 'entrystates', function(Blueprint $table) {

            $table->dropColumn('database_id');
            $table->dropColumn('category_id');

        } );
    }

}