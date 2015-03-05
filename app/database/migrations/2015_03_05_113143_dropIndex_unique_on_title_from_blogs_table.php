<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DropIndexUniqueOnTitleFromBlogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('blogs', function(Blueprint $table)
		{
			$table->dropUnique('blogs_title_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('blogs', function(Blueprint $table)
		{
			
		});
	}

}
