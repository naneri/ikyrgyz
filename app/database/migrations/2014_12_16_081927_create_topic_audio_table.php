<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTopicAudioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('topic_audio', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('topic_id')->unsigned();
                        $table->foreign('topic_id')->references('id')->on('topics');
                        $table->integer('album_id');
			$table->string('audio_url');
			$table->string('audio_title');
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
		Schema::drop('topic_audio');
	}

}
