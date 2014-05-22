<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFieldsToRevisionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('revisions', function(Blueprint $table) {
			
			$table->string('parent_type');
			$table->integer('parent_id'); 
			
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('revisions', function(Blueprint $table) {
			
			$table->dropColumn('parent_type');
			$table->dropColumn('parent_id');
			
		});
	}

}