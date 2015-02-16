<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CityTableSeeder extends Seeder {

	public function run()
	{
            //deletes all info
            DB::connection('mysql_users')->table('cities')->delete();

            // the data
            $cities = array(
                array(
                    'id' => '1',
                    'name' => 'Бишкек',
                    'country_id' => '1'
                ),
                array(
                    'id' => '2',
                    'name' => 'Ош',
                    'country_id' => '1'
                ),
                array(
                    'id' => '3',
                    'name' => 'Алматы',
                    'country_id' => '2'
                ),
                array(
                    'id' => '4',
                    'name' => 'Астана',
                    'country_id' => '2'
                ),
                array(
                    'id' => '5',
                    'name' => 'Москва',
                    'country_id' => '3'
                ),
                array(
                    'id' => '6',
                    'name' => 'Пермь',
                    'country_id' => '3'
                ),
            );

            DB::connection('mysql_users')->table('cities')->insert($cities);
        }

}