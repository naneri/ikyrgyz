<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNotifyPageToNotificationTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql_users')->table('notification_types', function(Blueprint $table)
		{
			$table->string('notify_page_message',250);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql_users')->table('notification_types', function(Blueprint $table)
		{
			$table->dropColumn('notify_page_message');
		});
	}

}
