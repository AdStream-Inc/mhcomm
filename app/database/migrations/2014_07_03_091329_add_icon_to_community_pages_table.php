<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddIconToCommunityPagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('community_pages', function(Blueprint $table)
		{
			$table->string('icon');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('community_pages', function(Blueprint $table)
		{
			$table->dropColumn('icon');
		});
	}

}
