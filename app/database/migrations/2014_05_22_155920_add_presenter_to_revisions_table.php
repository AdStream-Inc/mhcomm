<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPresenterToRevisionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('revisions', function(Blueprint $table) {
			
			$table->string('presenter'); 
			
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
			
			$table->dropColumn('presenter');
			
		});
	}

}
