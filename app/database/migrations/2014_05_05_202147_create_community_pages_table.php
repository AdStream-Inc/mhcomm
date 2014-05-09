<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommunityPagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('community_pages', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('community_id');
			$table->integer('parent_id');
			$table->string('name');
			$table->string('slug');
			$table->string('template');
			$table->string('enabled');
			$table->string('auth_only');
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
		Schema::drop('community_pages');
	}

}
