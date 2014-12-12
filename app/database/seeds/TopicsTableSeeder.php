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
		);

		// inserts the data
		DB::table('topics')->insert($topics);
	}

}