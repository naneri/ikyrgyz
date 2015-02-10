<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGenderBirthdayToUserDescription extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::connection('mysql_users')->table('user_description', function(Blueprint $table) {
                $table->enum('gender', array('male', 'female', 'other'))->default('other');
                $table->date('birthday');
            });
        }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::table('user_description', function(Blueprint $table) {

            });
        }

}
