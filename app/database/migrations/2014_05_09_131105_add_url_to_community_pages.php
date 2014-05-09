<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUrlToCommunityPages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('community_pages', function(Blueprint $table) {
			$table->string('url');
		});

		Schema::table('pages', function(Blueprint $table) {
			$table->string('url');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('community_pages', function(Blueprint $table) {
			$table->dropColumn('url');
		});

		Schema::table('pages', function(Blueprint $table) {
			$table->dropColumn('url');
		});
	}

}
