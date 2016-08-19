<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrylogsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrylogs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->integer('entry_id');
            $table->integer('action_id');
            $table->text('note');
            $table->longText('queries');
            $table->longText('revert_queries');

            $table->integer('database_id');
            $table->integer('category_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('entrylogs');
    }

}
