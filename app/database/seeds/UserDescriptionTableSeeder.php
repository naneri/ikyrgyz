<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class UserDescriptionTableSeeder extends Seeder {

	public function run()
	{
		DB::connection('mysql_users')->table('user_description')->delete();

		$descriptions = array(
			array('user_id' => 1),
			array('user_id' => 2),
			array('user_id' => 3),
			array('user_id' => 4),
			);

		User_Description::insert($descriptions);
	}

}