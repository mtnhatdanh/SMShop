<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemAttsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Create Item_atts table
		Schema::create('item_atts', function($table){
			$table->increments('id');
			$table->integer('itemType_id');
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
		//Drop Item_atts table
		Schema::drop('item_atts');
	}

}
