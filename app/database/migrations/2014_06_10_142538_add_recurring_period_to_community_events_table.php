<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRecurringPeriodToCommunityEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('community_events', function(Blueprint $table)
		{
			$table->string('recurring_frequency');
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
			$table->dropColumn('recurring_frequency');
		});
	}

}
