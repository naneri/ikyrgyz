<?php

class BlogsTableSeeder extends Seeder{


	public function run(){

		//deletes all info
		DB::table('blogs')->delete();

                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $this->call('BlogTypesTableSeeder');
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                // the data
		$blogs = array(
			array(
				'id' => 1,
				'user_id' => 1,
				'title' => 'Novii blog',
				'description' => 'zasdjhkqwe',
                                'blog_type_id' => 1
			),
			array(
				'id' => 2,
				'user_id' => 2,
				'title' => 'Vtoroi blog',
				'description' => 'zaasdasdjhkqwe',
                                'blog_type_id' => 2
                            ),
			array(
				'id' => 3,
				'user_id' => 2,
				'title' => 'Tretii blog',
				'description' => 'Tretii blog',
                                'blog_type_id' => 3
                            ),
			array(
				'id' => 4,
				'user_id' => 1,
				'title' => '4etvertii blog',
				'description' => 'etvertii blog',
                                'blog_type_id' => 1
                            ),
			array(
				'id' => 5,
				'user_id' => 2,
				'title' => '5iatii blog',
				'description' => '5iatii blog',
                                'blog_type_id' => 2
                            ),
		);

		// inserts the data
		DB::table('blogs')->insert($blogs);
	}

}