<?php

class UsersTableSeeder extends Seeder{


	public function run(){

		//deletes all info
		DB::table('users')->delete();

		// the data
		$users = array(
			array(
				'id' => '1',
				'email' => 'naneri@mail.ru',
				'password' => Hash::make('104430'),
				'is_admin' => 1
			),
			array(
				'id' => '2',
				'email' => 'ktnaneri@gmail.com',
				'password' => Hash::make('104430'),
				'is_admin' => 1
			)
		);

		// inserts the data
		DB::table('users')->insert($users);
		
	}


}