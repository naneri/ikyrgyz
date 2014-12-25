<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAudioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('audio', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->integer('album_id')->unsigned();
                        $table->foreign('album_id')->references('id')->on('photo_albums');
                        $table->integer('user_id')->unsigned();
                        $table->foreign('user_id')->references('id')->on('users');
                        $table->string('name');
			$table->string('url');
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
		Schema::drop('audio');
                DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        }

}
