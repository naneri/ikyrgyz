<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class UserDescriptionTableSeeder extends Seeder {

	public function run()
	{
		DB::table('user_description')->delete();

		$descriptions = array(
			array('id' => 1),
			array('id' => 2),
			array('id' => 3),
			array('id' => 4),
			);

		DB::table('user_description')->insert($descriptions);
	}

}