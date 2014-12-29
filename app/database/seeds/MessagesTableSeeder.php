<?php

class MessagesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('messages')->delete();
	}

}