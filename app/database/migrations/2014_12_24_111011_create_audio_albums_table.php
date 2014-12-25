<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAudioAlbumsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('audio_albums', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
                        $table->foreign('user_id')->references('id')->on('users');
			$table->string('name');
                        $table->string('cover');
			$table->integer('views');
			$table->float('rating');
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
		Schema::drop('audio_albums');
	}

}
