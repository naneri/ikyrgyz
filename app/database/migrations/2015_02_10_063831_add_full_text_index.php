<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFullTextIndex extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('full_text_index', function(Blueprint $table)
		{
                    DB::statement('ALTER TABLE `blogs` ADD FULLTEXT search(`title`, `description`)');
                    DB::statement('ALTER TABLE `topics` ADD FULLTEXT search(`title`, `description`)');
                });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('full_text_index', function(Blueprint $table)
		{
                        Schema::table('blogs', function($table) {
                            $table->dropIndex('search');
                        });
                        Schema::table('topics', function($table) {
                            $table->dropIndex('search');
                        });
                });
        }

}
