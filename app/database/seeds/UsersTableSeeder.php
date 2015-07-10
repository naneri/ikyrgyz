<?php

class UsersTableSeeder extends Seeder{


	public function run(){

		//deletes all info
		DB::connection('mysql_users')->table('users')->delete();

		$faker = Faker\Factory::create();


		User::create(array(
				'id' => '1',
				'email' => 'naneri@mail.ru',
				'password' => Hash::make('104430'),
				'is_admin' => 1,
				'activated' =>1

			));


		for ($i = 0; $i < 30; $i++)
		{
		  $users = User::create(array(
		    'email' 		=> $faker->email,
		    'password' 		=> Hash::make('104430'),
		    'is_admin' 		=> 0,
			'activated' 	=> 1,
			'created_at'	=> $faker->dateTimeThisYear
		  ));
		}
		
	}


}