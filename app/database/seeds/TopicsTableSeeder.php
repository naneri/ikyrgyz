<?php

class TopicsTableSeeder extends Seeder{


	public function run(){

		//deletes all info
		DB::table('topics')->delete();

		// the data
		$topics = array(
			array(
				'id' => 1,
				'blog_id' => 1,
				'user_id' => 1,
				'title' => 'start'
			),
			array(
				'id' => 2,
				'blog_id' => 2,
				'user_id' => 2,
				'title' => 'asdazasdaw'
			),
			array(
				'id' => 3,
				'blog_id' => 3,
				'user_id' => 2,
				'title' => '3tretii'
			),
			array(
				'id' => 4,
				'blog_id' => 1,
				'user_id' => 2,
				'title' => '4etvertii'
			),
			array(
				'id' => 5,
				'blog_id' => 2,
				'user_id' => 1,
				'title' => '5iatii'
			),
			array(
				'id' => 6,
				'blog_id' => 1,
				'user_id' => 1,
				'title' => '6estoi'
			),
		);

		// inserts the data
		DB::table('topics')->insert($topics);
	}

}