<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TopicTypesTableSeeder extends Seeder {

	public function run()
	{
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            
            //deletes all info
            DB::table('topic_types')->delete();

            // the data
            $users = array(
                array(
                    'id' => '1',
                    'name' => 'topic'
                ),
                array(
                    'id' => '2',
                    'name' => 'polling'
                ),
                array(
                    'id' => '3',
                    'name' => 'event'
                ),
                array(
                    'id' => '4',
                    'name' => 'link'
                )
            );

            // inserts the data
            DB::table('topic_types')->insert($users);
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    }

}