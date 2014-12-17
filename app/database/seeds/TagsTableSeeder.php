<?php

class TagsTableSeeder extends Seeder {

	public function run()
	{
            //deletes all info
            DB::table('tags')->delete();

            // the data
            $users = array(
                array(
                    'id' => '1',
                    'name' => 'text'
                ),
                array(
                    'id' => '2',
                    'name' => 'photo'
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
                )
            );

            // inserts the data
            DB::table('tags')->insert($users);
        }
}