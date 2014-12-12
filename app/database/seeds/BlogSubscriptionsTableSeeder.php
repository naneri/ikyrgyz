<?php

class BlogsSubscriptionsTableSeeder extends Seeder{


	public function run(){

		//deletes all info
		DB::table('blog_subscriptions')->delete();

		// the data
		$BlogsSubscriptions = array(
			array(
				'id' => 1,
				'blog_id' => 1,
				'user_id' => 1
			),
			array(
				'id' => 2,
				'blog_id' => 2,
				'user_id' => 2
			),
		);

		// inserts the data
		DB::table('blog_subscriptions')->insert($BlogsSubscriptions);
	}

}