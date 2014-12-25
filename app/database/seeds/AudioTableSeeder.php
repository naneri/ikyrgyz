<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AudioTableSeeder extends Seeder {

	public function run() {
            //deletes all info
            DB::table('audio')->delete();

            // the data
            $audio = array(
                array(
                    'id' => '1',
                    'name' => 'text',
                    'url' => '/images/2014/12/18/SbUqdKds0zPBP9igxepYaFWaMb4cHF.jpg',
                    'album_id' => '1',
                    'user_id' => '1'
                ),
                array(
                    'id' => '2',
                    'name' => 'text',
                    'url' => '/images/2014/12/18/JRsZ7LHyc1ame1GkUVmn7l38JSh3VV.jpg',
                    'album_id' => '1',
                    'user_id' => '1'
                ),
            );

            DB::table('audio')->insert($audio);
        }

}