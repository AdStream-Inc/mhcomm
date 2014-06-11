<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddHomePageToSpecialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('specials', function(Blueprint $table)
		{
			$table->boolean('on_homepage');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('specials', function(Blueprint $table)
		{
			$table->dropColumn('on_homepage');
		});
	}

}
