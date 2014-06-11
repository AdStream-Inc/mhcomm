<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateStartTimeAndEndTimeForCommunityEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('community_events', function(Blueprint $table)
		{
			$table->dropColumn('start_time');
			$table->dropColumn('end_time');
		});

		Schema::table('community_events', function(Blueprint $table)
		{
			$table->string('start_time');
			$table->string('end_time');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('community_events', function(Blueprint $table)
		{

		});
	}

}
