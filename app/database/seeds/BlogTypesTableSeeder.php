<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class BlogTypesTableSeeder extends Seeder {

	public function run()
	{
            //deletes all info
            DB::table('blog_types')->delete();

            // the data
            $users = array(
                array(
                    'id' => '1',
                    'type' => 'personal'
                ),
                array(
                    'id' => '2',
                    'type' => 'open'
                ),
                array(
                    'id' => '3',
                    'type' => 'close'
                )
                
            );

            // inserts the data
            DB::table('blog_types')->insert($users);
        }

}