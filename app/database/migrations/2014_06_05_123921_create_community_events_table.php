<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommunityEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('community_events', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('community_id');
			$table->string('name');
			$table->datetime('start_date');
			$table->datetime('end_date');
			$table->datetime('start_time');
			$table->datetime('end_time');
			$table->text('description');
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
		Schema::drop('community_events');
	}

}
