<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommunityChangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('community_changes', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('community_id');
			$table->integer('user_id');
			$table->string('column_key');
			$table->string('before_value');
			$table->string('after_value');
			$table->boolean('approved');
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
		Schema::drop('community_changes');
	}

}
