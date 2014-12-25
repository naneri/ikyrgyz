<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTopicTypes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('topic_types', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('name')->unique();
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
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            Schema::drop('topic_types');
	}

}
