<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TopicTypesTableSeeder extends Seeder {

	public function run()
	{
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
                )
            );

            // inserts the data
            DB::table('topic_types')->insert($users);
        }

}