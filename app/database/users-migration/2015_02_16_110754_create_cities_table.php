<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql_users')->create('cities', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->integer('country_id')->unsigned();
                        $table->foreign('country_id')->references('id')->on('countries');
                        $table->string('name', 250);
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
		Schema::connection('mysql_users')->drop('cities');
	}

}
