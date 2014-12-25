<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PhotoAlbumTopicTableSeeder extends Seeder {

	public function run()
	{
		DB::table('photo_album_topic')->delete();
                
                $photoAlbumTopic = array(
                    array(
                        'id' => '1',
                        'photo_album_id' => '1',
                        'topic_id' => '1'
                    ),
                    array(
                        'id' => '2',
                        'photo_album_id' => '2',
                        'topic_id' => '2'
                    ),
                    array(
                        'id' => '3',
                        'photo_album_id' => '3',
                        'topic_id' => '3'
                    ),
                    array(
                        'id' => '4',
                        'photo_album_id' => '4',
                        'topic_id' => '4'
                    ),
                );
                
                DB::table('photo_album_topic')->insert($photoAlbumTopic);
	}

}