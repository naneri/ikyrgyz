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
		Schema::create('photos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('album_id')->unsigned();
                        $table->foreign('album_id')->references('id')->on('photo_albums');
                        $table->integer('user_id');
			$table->string('name');
			$table->string('url');
                        $table->integer('views');
			$table->float('rating', 9, 3)->default(0);
			$table->integer('vote_up');
			$table->integer('vote_down');
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
		Schema::drop('photos');
	}

}
