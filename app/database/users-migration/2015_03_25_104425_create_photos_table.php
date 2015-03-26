<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql_users')->create('photos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('album_id')->unsigned();
                        $table->foreign('album_id')->references('id')->on('photo_albums');
                        $table->integer('user_id');
			$table->string('name');
			$table->string('url');
                        $table->integer('views')->default(0);
			$table->float('rating', 9, 3)->default(0);
			$table->integer('vote_up')->default(0);
			$table->integer('vote_down')->default(0);
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
		Schema::connection('mysql_users')->drop('photos');
	}

}
