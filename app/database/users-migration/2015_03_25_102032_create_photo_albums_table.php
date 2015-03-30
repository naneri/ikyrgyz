<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhotoAlbumsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql_users')->create('photo_albums', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('name', 250);
			$table->string('cover');
                        $table->string('description');
                        $table->string('access', 20);
			$table->integer('views')->default(0);
                        $table->float('rating', 9, 3)->default(0);
                        $table->integer('vote_up')->default(0);
                        $table->integer('vote_down')->default(0);
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
		Schema::connection('mysql_users')->drop('photo_albums');
	}

}
