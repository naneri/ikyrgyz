<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PhotoAlbumsTableSeeder extends Seeder {

	public function run()
	{
            
                //deletes all info
                DB::table('photo_albums')->delete();

                // the data
                $photoAlbums = array(
                        array(
                            'id' => '1',
                            'name' => 'Мой фотоальбом',
                            'user_id' => 1
                        ),
                );
                
                DB::table('photo_albums')->insert($photoAlbums);
        }

}