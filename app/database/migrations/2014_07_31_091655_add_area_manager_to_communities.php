<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddAreaManagerToCommunities extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('communities', function(Blueprint $table)
		{
			$table->string('area_manager');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('communities', function(Blueprint $table)
		{
			$table->dropColumn('area_manager');
		});
	}

}
