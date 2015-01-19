<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUnneededSoftdeletes extends Migration
{

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('entrystates', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('entrycategories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('entryactions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('entrydatabases', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('entrystates', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('entrycategories', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('entryactions', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('entrydatabases', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

}