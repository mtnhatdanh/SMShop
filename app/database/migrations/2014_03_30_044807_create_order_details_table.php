<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Create Order_details table
		Schema::create('order_details', function($table){
			$table->increments('id');
			$table->integer('order_id');
			$table->integer('item_id');
			$table->string('size');
			$table->integer('qty');
			$table->integer('price');
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
		//Drop Order_details table
		Schema::drop('order_details');
	}

}
