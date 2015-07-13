<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class UserDescriptionTableSeeder extends Seeder {

	public function run()
	{
		
		DB::connection('mysql_users')->table('user_description')->delete();

		$faker = Faker\Factory::create();

		$users = User::all();
		foreach ($users as $user) {
			$city 		= City::orderByRaw("RAND()")->first();
			$birth_city = City::orderByRaw("RAND()")->first();
			User_Description::create([
				'user_id' 				=> $user->id,
				'user_profile_about'	=> $faker->paragraph(3),
				'user_profile_avatar'	=> 'http://lorempixel.com/220/220/',
				'first_name'			=> $faker->firstName,
				'last_name'				=> $faker->lastName,
				'gender'                => array_rand(['male', 'female', 'other']),
				'birthday'				=> $faker->dateTimeBetween('-30 years', '-20 years'),
				'liveplace_country_id'	=> $city->country_id,
				'liveplace_city_id'		=> $city->id,
				'birthplace_country_id'	=> $birth_city->country_id,
				'birthplace_city_id'	=> $birth_city->id,
				'about_me'				=> $faker->paragraph(3)
				]);
		}


	}

}