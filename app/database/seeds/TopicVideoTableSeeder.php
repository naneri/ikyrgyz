<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TopicVideoTableSeeder extends Seeder {

	public function run()
	{
            //deletes all info
            DB::table('topic_video')->delete();
            
            $video = array(
                    array(
                        'id' => 1,
                        'topic_id' => 8,
                        'url' => 'https://www.youtube.com/watch?v=kaDiTRpCpcY',
                        'embed_code' => '<iframe width="420" height="345" frameborder="0" allowfullscreen src="http://www.youtube.com/embed/kaDiTRpCpcY"></iframe>'
                    ),
            );
            
            // inserts the data
            DB::table('topic_video')->insert($video);
        }

}