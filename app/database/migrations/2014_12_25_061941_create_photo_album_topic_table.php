<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhotoAlbumTopicTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('photo_album_topic', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('photo_album_id')->unsigned()->index();
			$table->foreign('photo_album_id')->references('id')->on('photo_albums')->onDelete('cascade');
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
		Schema::drop('photo_album_topic');
	}

}
