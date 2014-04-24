<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menus', function($table) {
			$table->increments('id');
			$table->string('slug');
			$table->integer('lft');
			$table->integer('rgt');
			$table->integer('menu');
			$table->string('name')->nullable();
			$table->string('type')->default('static');
			$table->string('uri')->nullable();
			$table->string('class')->nullable();
			$table->string('regex')->nullable();
			$table->boolean('enabled')->default(1);
			$table->timestamps();

			$table->engine = 'InnoDB';
			$table->unique(array('lft', 'rgt', 'menu', 'slug'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menus');
	}

}
