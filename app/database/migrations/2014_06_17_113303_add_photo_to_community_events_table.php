<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPhotoToCommunityEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('community_events', function(Blueprint $table)
		{
			$table->string('image_url');
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
			$table->dropColumn('image_url');
		});
	}

}
