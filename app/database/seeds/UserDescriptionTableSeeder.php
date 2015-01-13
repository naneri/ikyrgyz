<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class UserDescriptionTableSeeder extends Seeder {

	public function run()
	{
		DB::connection('mysql_users')->table('user_description')->delete();

		$descriptions = array(
			array('id' => 1),
			array('id' => 2),
			array('id' => 3),
			array('id' => 4),
			);

		User_Description::insert($descriptions);
	}

}