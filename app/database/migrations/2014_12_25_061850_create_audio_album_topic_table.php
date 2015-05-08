<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAudioAlbumTopicTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('audio_album_topic', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('audio_album_id')->unsigned()->index();
			$table->foreign('audio_album_id')->references('id')->on('audio_albums')->onDelete('cascade');
			$table->integer('topic_id')->unsigned()->index();
			$table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
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
		Schema::drop('audio_album_topic');
	}

}
