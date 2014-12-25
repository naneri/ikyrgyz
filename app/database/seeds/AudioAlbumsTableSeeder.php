<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AudioAlbumsTableSeeder extends Seeder {

	public function run() {

        //deletes all info
        DB::table('audio_albums')->delete();

        // the data
        $audioAlbums = array(
            array(
                'id' => '1',
                'name' => 'Мой альбом',
                'user_id' => 1
            ),
            array(
                'id' => '2',
                'name' => 'my album',
                'user_id' => 1
            ),
            array(
                'id' => '3',
                'name' => 'third album',
                'user_id' => 1
            ),
            array(
                'id' => '4',
                'name' => 'fourth album',
                'user_id' => 1
            ),
        );

        DB::table('audio_albums')->insert($audioAlbums);
    }

}