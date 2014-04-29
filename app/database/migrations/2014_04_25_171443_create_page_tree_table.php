<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePageTreeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::drop('menus');

		Schema::create('page_tree', function(Blueprint $table) {
			$table->increments('id');
			$table->string('page_id');
			$table->integer('lft');
			$table->integer('rgt');
			$table->integer('tree');
			$table->timestamps();

			$table->engine = 'InnoDB';
			$table->unique(array('lft', 'rgt'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('page_tree');
	}

}
