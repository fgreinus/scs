<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrystatesTable extends Migration
{

    public function up()
    {
        Schema::create('entrystates', function (Blueprint $table) {

            $table->increments('id');

            $table->string('code');
            $table->string('name');
            $table->string('color');
            $table->integer('action_id');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('entrystates');
    }

}