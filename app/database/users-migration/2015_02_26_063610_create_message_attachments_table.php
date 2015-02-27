<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessageAttachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql_users')->create('message_attachments', function(Blueprint $table) {
                    $table->increments('id');
                    $table->integer('message_id');
                    $table->string('type', 50);
                    $table->string('name');
                    $table->string('path');
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
		Schema::drop('message_attachments');
	}

}
