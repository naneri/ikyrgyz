<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSubtypeValueDelNameToProfileItem extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql_users')->table('profile_items', function(Blueprint $table)
		{
                    $table->string('subtype', 20)->after('type');
                    $table->string('value')->after('subtype');
                    $table->dropColumn('name');
                });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql_users')->table('profile_items', function(Blueprint $table)
		{
			
		});
	}

}
