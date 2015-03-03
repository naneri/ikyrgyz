<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNamesAboutmeMaritalstatusAccessesToUserDescription extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql_users')->table('user_description', function(Blueprint $table)
		{
                    $table->string('names_access', 20)->after('last_name');
                    $table->string('about_me_access')->after('about_me');
                    $table->string('marital_status_access')->after('marital_status');
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
