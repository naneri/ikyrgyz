<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBonusRatingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('bonus_ratings', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('target_id');
            $table->string('target_type');
            $table->integer('user_id');
            $table->integer('value');
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
        Schema::drop('bonus_ratings');
	}

}
