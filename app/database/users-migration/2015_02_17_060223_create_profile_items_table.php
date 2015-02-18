<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfileItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql_users')->create('profile_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type', 20);
                        $table->string('name', 250);
                        $table->integer('user_id')->unsigned()->index();
                        $table->date('date_begin');
                        $table->date('date_end');
                        $table->string('description');
                        $table->string('meta_1', 250);
                        $table->string('meta_2', 250);
                        $table->string('access', 20);
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
		Schema::connection('mysql_users')->drop('profile_items');
	}

}
