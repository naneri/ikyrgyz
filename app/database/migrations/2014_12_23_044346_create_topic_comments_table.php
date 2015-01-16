<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTopicCommentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('topic_comments', function(Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->integer('topic_id')->unsigned();
            $table->foreign('topic_id')->references('id')->on('topics');
            $table->integer('user_id');
            $table->integer('parent_id');
            $table->boolean('trash');
            $table->float('rating')->default(0);
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
    public function down() {
        Schema::drop('topic_comments');
    }

}
