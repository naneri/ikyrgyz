<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blogs', function(Blueprint $table){
			$table->increments('id');
			$table->integer('user_id');
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('blog_types');
            $table->string('title', 200)->unique();
			$table->string('description')->nullable();
			$table->float('rating')->default(0);
			$table->integer('count_vote')->default(0);
			$table->integer('count_user')->default(0);
			$table->string('avatar')->nullable();
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
		Schema::drop('blogs');
	}

}
