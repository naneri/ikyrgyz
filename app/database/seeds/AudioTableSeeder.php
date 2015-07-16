<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AudioTableSeeder extends Seeder {

	public function run() {
            //deletes all info
            DB::table('audio')->delete();

            // the data
            $audio = array();

            DB::table('audio')->insert($audio);
        }

}