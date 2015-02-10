<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCollegeToUserDescriptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql_users')->table('user_description', function(Blueprint $table)
		{
			$table->string('country', 50);
			$table->string('school',250);
			$table->string('univesity', 250);
			$table->string('job',250);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_description', function(Blueprint $table)
		{
			
		});
	}

}
