<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DropPhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
                DB::statement('SET FOREIGN_KEY_CHECKS = 0');
                DB::connection('mysql')->table('photos')->delete();
                Schema::connection('mysql')->drop('photo_topic');
                Schema::connection('mysql')->drop('photos');
                DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        }


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	}

}
