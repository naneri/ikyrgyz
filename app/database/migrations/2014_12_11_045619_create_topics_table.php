<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTopicsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('topics', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('blog_id')->unsigned();
			$table->integer('user_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->string('title', 100);
            $table->text('description');
            $table->integer('admin_banned')->default(0);
			$table->integer('draft')->default(0);
            $table->float('rating')->default(0);
            $table->integer('vote_up')->default(0);
			$table->integer('vote_down')->default(0);
			$table->integer('count_read')->default(0);
			$table->integer('count_comment')->default(0);
			$table->integer('count_favorite')->default(0);
			$table->timestamps();
		});
                
		Schema::table('topics', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('blog_id')->references('id')->on('blogs');
            $table->foreign('type_id')->references('id')->on('topic_types');
        });
    }


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('topics');
	}

}
