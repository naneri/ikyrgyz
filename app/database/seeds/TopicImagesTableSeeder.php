<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TopicImagesTableSeeder extends Seeder {

	public function run()
	{
                //deletes all info
                DB::table('topic_images')->delete();

                $images = array(
                    array(
                        'id' => 1,
                        'topic_id' => 7,
                        'url' => '/images/2014/12/18/SbUqdKds0zPBP9igxepYaFWaMb4cHF.jpg',
                        'title' => 'nature'
                    ),
                    array(
                        'id' => 2,
                        'topic_id' => 7,
                        'url' => '/images/2014/12/18/JRsZ7LHyc1ame1GkUVmn7l38JSh3VV.jpg',
                        'title' => 'nature'
                    ),
                );

                // inserts the data
                DB::table('topic_images')->insert($images);
        }

}