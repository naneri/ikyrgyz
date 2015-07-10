<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CityTableSeeder extends Seeder {

	public function run()
	{
            //deletes all info
             
            DB::connection('mysql_users')->table('cities')->delete();
            DB::connection('mysql_users')->unprepared(file_get_contents(dirname(__FILE__).'/cities_dump.sql'));
           
        }

}