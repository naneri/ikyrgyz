<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddAboutMeMaritalStatusToUserDescription extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql_users')->table('user_description', function(Blueprint $table)
		{
                    $table->string('about_me');
                    $table->string('marital_status', 50);
                });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql_users')->table('user_description', function(Blueprint $table)
		{
			
		});
	}

}
