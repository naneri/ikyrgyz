<?php

class TopicsTableSeeder extends Seeder{


	public function run(){

		//deletes all info
		DB::table('topics')->delete();
                
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');

                //... List of Seeder calls like
                $this->call('TopicTypesTableSeeder');
                $this->call('UsersTableSeeder');
                $this->call('BlogsTableSeeder');

                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                
                // the data
		$topics = array(
			array(
				'id' => 1,
				'blog_id' => 1,
				'user_id' => 1,
                                'type_id' => 1,
				'title' => 'Эпос "Манас"',
                                'content' => 'Традиционно ведущее место в устном народном творчестве киргизов — это эпический жанр, жемчужиной которого является героический эпос — трилогия «Манас», рассказывающий о подвигах богатыря Манаса, его сына Семетея и внуке Сейтека. Образ женщины-киргизки отражает портрет красавицы Каныкей — жены Манаса, умной, проницательной, прекрасной. В эпосе изображён быт киргизов, свадьбы, поминки, торжества, семейная жизнь.'
			),
			array(
				'id' => 2,
				'blog_id' => 2,
				'user_id' => 2,
                                'type_id' => 2,
                                'title' => 'в устном народном творчестве киргизов',
                                'content' => 'Традиционно ведущее место в устном народном творчестве киргизов — это эпический жанр'
                            ),
			array(
				'id' => 3,
				'blog_id' => 3,
				'user_id' => 2,
                                'type_id' => 3,
                                'title' => 'эпический жанр',
                                'content' => 'эпический жанр, жемчужиной которого является героический эпос — трилогия «Манас»'
                            ),
			array(
				'id' => 4,
				'blog_id' => 1,
				'user_id' => 2,
                                'type_id' => 4,
                                'title' => 'трилогия «Манас»',
                                'content' => 'трилогия «Манас», рассказывающий о подвигах богатыря Манаса, его сына Семетея и внуке Сейтека'
                            ),
			array(
				'id' => 5,
				'blog_id' => 2,
				'user_id' => 1,
                                'type_id' => 5,
                                'title' => 'Каныкей',
                                'content' => 'Образ женщины-киргизки отражает портрет красавицы Каныкей — жены Манаса, умной, проницательной, прекрасной.'
                            ),
			array(
				'id' => 6,
				'blog_id' => 1,
				'user_id' => 1,
                                'type_id' => 6,
                                'title' => '6estoi',
                                'content' => ''
                            ),
		);

		// inserts the data
		DB::table('topics')->insert($topics);
	}

}