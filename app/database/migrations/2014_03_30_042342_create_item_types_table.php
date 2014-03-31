<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Create Item_types table
		Schema::create('item_types', function($table){
			$table->increments('id');
			$table->integer('category_id');
			$table->string('name');
			$table->boolean('enable')->default(1);
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
		//Drop item_types table
		Schema::drop('item_types');
	}

}
