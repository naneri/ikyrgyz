<?php

class BlogsTableSeeder extends Seeder{


	public function run(){

		//deletes all info
		DB::table('blogs')->delete();

		// the data
		$blogs = array(
			array(
				'id' => 1,
				'user_id' => 1,
				'title' => 'Novii blog',
				'description' => 'zasdjhkqwe',
			),
			array(
				'id' => 2,
				'user_id' => 2,
				'title' => 'Vtoroi blog',
				'description' => 'zaasdasdjhkqwe',
			),
			array(
				'id' => 3,
				'user_id' => 2,
				'title' => 'Tretii blog',
				'description' => 'Tretii blog',
			),
			array(
				'id' => 4,
				'user_id' => 1,
				'title' => '4etvertii blog',
				'description' => 'etvertii blog',
			),
			array(
				'id' => 5,
				'user_id' => 2,
				'title' => '5iatii blog',
				'description' => '5iatii blog',
			),
		);

		// inserts the data
		DB::table('blogs')->insert($blogs);
	}

}