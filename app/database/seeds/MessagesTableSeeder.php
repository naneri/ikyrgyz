<?php

class MessagesTableSeeder extends Seeder {

	public function run()
	{
		DB::connection('mysql_users')->table('messages')->delete();
	}

}