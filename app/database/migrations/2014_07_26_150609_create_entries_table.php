<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entries', function(Blueprint $table)
		{
			$table->increments('id');

            $table->integer('user_id');
            $table->text('title', 64);
            $table->integer('database_id');
            $table->integer('category_id');
            $table->text('queries');
            $table->text('revert_queries');
            $table->integer('state_id');
            $table->integer('ticket_id');
            $table->softDeletes();

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
		Schema::drop('queries');
	}

}
