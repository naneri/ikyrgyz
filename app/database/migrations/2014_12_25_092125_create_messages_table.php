<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sender_id')->unsigned();
			$table->foreign('sender_id')->references('id')->on('users');
			$table->integer('receiver_id')->unsigned();
			$table->foreign('receiver_id')->references('id')->on('users');
			$table->string('text',4000);
			$table->integer('watched')->default(0);
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
		Schema::drop('messages');
	}

}
