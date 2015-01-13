<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class FriendTableSeeder extends Seeder {

	public function run()
	{
		DB::connection('mysql_users')->table('friends')->delete();

		$friends = array(
			array(
				'user_one' => 1,
				'user_two' => 3,
				'status' => Config::get('social.friend_status.friends'),
			),
			array(
				'user_one' => 3,
				'user_two' => 1,
				'status' => Config::get('social.friend_status.friends'),
			),
			array(
				'user_one' => 1,
				'user_two' => 4,
				'status' => Config::get('social.friend_status.friends'),
			),
			array(
				'user_one' => 4,
				'user_two' => 1,
				'status' => Config::get('social.friend_status.friends'),
			),
		);

		Friend::insert($friends);
	}

}