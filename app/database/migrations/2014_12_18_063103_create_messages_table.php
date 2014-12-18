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
			$table->integer('reciever_id')->unsigned();
			$table->string('title', 100);
            $table->string('content');
			$table->timestamps();
		});

		Schema::table('messages', function(Blueprint $table) {
            $table->foreign('sender_id')->references('id')->on('users');
            $table->foreign('reciever_id')->references('id')->on('users');
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
