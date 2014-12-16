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
                    'type' => 'text'
                ),
                array(
                    'id' => '2',
                    'type' => 'photo'
                ),
                array(
                    'id' => '3',
                    'type' => 'audio'
                ),
                array(
                    'id' => '4',
                    'type' => 'video'
                ),
                array(
                    'id' => '5',
                    'type' => 'music'
                ),
                array(
                    'id' => '6',
                    'type' => 'link'
                ),
                array(
                    'id' => '7',
                    'type' => 'polling'
                ),
                array(
                    'id' => '8',
                    'type' => 'event'
                )
            );

            // inserts the data
            DB::table('topic_types')->insert($users);
        }

}