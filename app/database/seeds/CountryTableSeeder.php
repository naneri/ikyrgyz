<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CountryTableSeeder extends Seeder {

	public function run()
	{
            //deletes all info
            DB::connection('mysql_users')->table('countries')->delete();
            DB::connection('mysql_users')->unprepared(file_get_contents(dirname(__FILE__) . '/countries_dump.sql'));
            
        }

}