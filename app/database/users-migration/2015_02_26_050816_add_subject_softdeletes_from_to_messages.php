<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSubjectSoftdeletesFromToMessages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql_users')->table('messages', function(Blueprint $table) {
                    $table->string('from', 20)->after('id');
                    $table->string('title', 250)->after('receiver_id');
                    $table->boolean('draft')->after('watched');
                    $table->softDeletes();
                });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql_users')->table('messages', function(Blueprint $table)
		{
			
		});
	}

}
