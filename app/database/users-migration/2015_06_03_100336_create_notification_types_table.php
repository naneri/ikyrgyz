<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql_users')->create('notification_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('lang_message', 400);
			$table->string('mail_template', 400);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql_users')->drop('notification_types');
	}

}
