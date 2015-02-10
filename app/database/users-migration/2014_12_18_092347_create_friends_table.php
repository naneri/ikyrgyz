<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFriendsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql_users')->create('friends', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_one')->unsigned();
			$table->foreign('user_one')->references('id')->on('users');
			$table->integer('user_two')->unsigned();
			$table->foreign('user_two')->references('id')->on('users');
			$table->integer('status');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('friends');
	}

}
