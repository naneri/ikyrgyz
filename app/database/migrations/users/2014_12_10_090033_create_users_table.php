<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::connection('mysql_users')->create('users', function(Blueprint $table){
			$table->increments('id');
			$table->string('email');
			$table->string('password');
			$table->integer('is_admin')->nullable();
			$table->float('rating', 9, 3)->default(0);
                        $table->float('skill', 9, 3)->default(0);
			$table->rememberToken();
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
		Schema::drop('users');
	}

}
