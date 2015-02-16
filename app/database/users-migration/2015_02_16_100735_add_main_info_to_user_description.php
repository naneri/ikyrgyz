<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddMainInfoToUserDescription extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::connection('mysql_users')->table('user_description', function(Blueprint $table) {
                $table->string('birthday_access', 20)->after('birthday');
                $table->string('gender_access', 20)->after('gender');
                $table->integer('liveplace_country_id');
                $table->integer('liveplace_city_id');
                $table->string('liveplace_access', 20)->after('liveplace_city_id');
                $table->integer('birthplace_country_id');
                $table->integer('birthplace_city_id');
                $table->string('birthplace_access', 20)->after('birthplace_city_id');
                $table->dropColumn('country');
                $table->dropColumn('school');
                $table->dropColumn('univesity');
                $table->dropColumn('job');
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
