<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTopicVideoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('topic_video', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('topic_id')->unsigned();
                        $table->foreign('topic_id')->references('id')->on('topics');
                        $table->string('url');
			$table->string('embed_code');
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
		Schema::drop('topic_video');
	}

}
