<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//create Users table
		Schema::create('users', function($table){
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('address');
			$table->string('phone');
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
		//Drop Users table
		Schema::drop('users');
	}

}
