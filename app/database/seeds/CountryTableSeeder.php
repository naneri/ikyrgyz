<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CountryTableSeeder extends Seeder {

	public function run()
	{
            //deletes all info
            DB::connection('mysql_users')->table('countries')->delete();

            // the data
            $countries = array(
                array(
                    'id' => '1',
                    'name' => 'Кыргызстан'
                ),
                array(
                    'id' => '2',
                    'name' => 'Казахстан'
                ),
                array(
                    'id' => '3',
                    'name' => 'Россия'
                )
            );

            // inserts the data
            DB::connection('mysql_users')->table('countries')->insert($countries);
        }

}