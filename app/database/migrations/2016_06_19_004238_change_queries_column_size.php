<?php

use Illuminate\Database\Migrations\Migration;

class ChangeQueriesColumnSize extends Migration
{

    public function up()
    {
        DB::statement('ALTER TABLE entries MODIFY COLUMN queries LONGTEXT;');
        DB::statement('ALTER TABLE entries MODIFY COLUMN revert_queries LONGTEXT;');
    }

    public function down()
    {
        DB::statement('ALTER TABLE entries MODIFY COLUMN queries TEXT;');
        DB::statement('ALTER TABLE entries MODIFY COLUMN revert_queries TEXT;');
    }

}