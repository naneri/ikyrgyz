<?php

class BlogsSubscriptionsTableSeeder extends Seeder{


	public function run(){

		//deletes all info
		DB::table('blog_subscriptions')->delete();

		// the data
		$BlogsSubscriptions = array(
			array(
				'blog_id' => 1,
				'user_id' => 1,
                                'status_id' => 1
			),
			array(
				'blog_id' => 2,
				'user_id' => 2,
                                'status_id' => 1
                        ),
			array(
				'blog_id' => 3,
				'user_id' => 1,
                                'status_id' => 1
                        ),
		);

		// inserts the data
		DB::table('blog_subscriptions')->insert($BlogsSubscriptions);
	}

}