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
                    'name' => 'text'
                ),
                array(
                    'id' => '2',
                    'name' => 'image'
                ),
                array(
                    'id' => '3',
                    'name' => 'audio'
                ),
                array(
                    'id' => '4',
                    'name' => 'video'
                ),
                array(
                    'id' => '5',
                    'name' => 'music'
                ),
                array(
                    'id' => '6',
                    'name' => 'link'
                ),
                array(
                    'id' => '7',
                    'name' => 'polling'
                ),
                array(
                    'id' => '8',
                    'name' => 'event'
                ),
                array(
                    'id' => '9',
                    'name' => 'draft'
                )
            );

            // inserts the data
            DB::table('topic_types')->insert($users);
        }

}