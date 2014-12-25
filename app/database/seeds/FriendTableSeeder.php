<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class FriendTableSeeder extends Seeder {

	public function run()
	{
		DB::table('friends')->delete();

		$friends = array(
			array(
				'user_from' => 1,
				'user_to' => 3,
				'status' => Config::get('social.friend_status.friends'),
			),
			array(
				'user_from' => 3,
				'user_to' => 1,
				'status' => Config::get('social.friend_status.friends'),
			),
			array(
				'user_from' => 1,
				'user_to' => 4,
				'status' => Config::get('social.friend_status.friends'),
			),
			array(
				'user_from' => 4,
				'user_to' => 1,
				'status' => Config::get('social.friend_status.friends'),
			),
		);
	}

}