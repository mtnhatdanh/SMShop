<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Create Items Table
		Schema::create('items', function($table){
			$table->increments('id');
			$table->integer('itemAtt_id');
			$table->string('name');
			$table->integer('price');
			$table->text('description');
			$table->string('urlPic1');
			$table->string('urlPic2');
			$table->string('size_available');
			$table->boolean('onsale');
			$table->integer('sale_price');
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
		//Drop Items table
		Schema::drop('items');
	}

}
