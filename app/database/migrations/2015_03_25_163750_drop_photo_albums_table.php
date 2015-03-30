<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DropPhotoAlbumsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            DB::connection('mysql')->table('photo_albums')->delete();
            Schema::connection('mysql')->drop('photo_album_topic');
            Schema::connection('mysql')->drop('photo_albums');
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
