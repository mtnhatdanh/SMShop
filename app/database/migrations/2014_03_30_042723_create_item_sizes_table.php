<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemSizesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Create Item_sizes table
		Schema::create('item_sizes', function($table){
			$table->increments('id');
			$table->integer('itemType_id');
			$table->string('value');
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
		//Drop Item_sizes table
		Schema::drop('item_sizes');
	}

}
