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
		);

		// inserts the data
		DB::table('blogs')->insert($blogs);
	}

}