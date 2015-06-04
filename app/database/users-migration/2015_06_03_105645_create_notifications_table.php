<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql_users')->create('notifications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('body', 4000);
			$table->integer('reciever_id');
			$table->integer('type_id');
			$table->integer('notified')->nullable();
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
		Schema::connection('mysql_users')->drop('notifications');
	}

}
