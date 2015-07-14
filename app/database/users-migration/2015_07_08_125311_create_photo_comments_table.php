<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhotoCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql_users')->create('photo_comments', function(Blueprint $table)
		{
                    $table->increments('id');
                    $table->string('text');
                    $table->integer('photo_id')->unsigned();
                    $table->foreign('photo_id')->references('id')->on('photos');
                    $table->integer('user_id');
                    $table->integer('parent_id');
                    $table->boolean('trash');
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
		Schema::connection('mysql_users')->drop('photo_comments');
	}

}
