<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TopicCommentsTableSeeder extends Seeder {

	public function run()
	{
            //deletes all info
            DB::table('topic_comments')->delete();

            $comments = array(
                array(
                    'id' => 1,
                    'topic_id' => 6,
                    'text' => 'c',
                    'parent_id' => 0
                ),
                array(
                    'id' => 2,
                    'topic_id' => 6,
                    'text' => 'co',
                    'parent_id' => 1
                ),
                array(
                    'id' => 3,
                    'topic_id' => 6,
                    'text' => 'com',
                    'parent_id' => 2
                ),
                array(
                    'id' => 4,
                    'topic_id' => 6,
                    'text' => 'comm',
                    'parent_id' => 3
                ),
                array(
                    'id' => 5,
                    'topic_id' => 6,
                    'text' => 'comme',
                    'parent_id' => 4
                ),
                array(
                    'id' => 6,
                    'topic_id' => 6,
                    'text' => 'commen',
                    'parent_id' => 5
                ),
                array(
                    'id' => 7,
                    'topic_id' => 6,
                    'text' => 'comment',
                    'parent_id' => 6
                ),
                array(
                    'id' => 8,
                    'topic_id' => 6,
                    'text' => 'comment 1',
                    'parent_id' => 3
                ),
                array(
                    'id' => 9,
                    'topic_id' => 6,
                    'text' => 'comment 2',
                    'parent_id' => 2
                ),
                array(
                    'id' => 10,
                    'topic_id' => 6,
                    'text' => 'comment 3',
                    'parent_id' => 1
                ),
                array(
                    'id' => 11,
                    'topic_id' => 6,
                    'text' => 'comment 4',
                    'parent_id' => 0
                ),
        );

            // inserts the data
            DB::table('topic_comments')->insert($comments);
        }

}