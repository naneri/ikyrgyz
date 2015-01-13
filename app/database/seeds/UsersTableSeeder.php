<?php

class UsersTableSeeder extends Seeder{


	public function run(){

		//deletes all info
		DB::connection('mysql_users')->table('users')->delete();

		// the data
		$users = array(
			array(
				'id' => '1',
				'email' => 'naneri@mail.ru',
				'password' => Hash::make('104430'),
				'is_admin' => 1,
				'activated' =>1
			),
			array(
				'id' => '2',
				'email' => 'ktnaneri@gmail.com',
				'password' => Hash::make('104430'),
				'is_admin' => 1,
				'activated' =>1
			),
			array(
				'id' => '3',
				'email' => 'yrysbek@gmail.com',
				'password' => Hash::make('asjkasjh1234'),
				'is_admin' => 0,
				'activated' =>1
			),
			array(
				'id' => '4',
				'email' => 'aazasd@gmail.com',
				'password' => Hash::make('1044asq12330'),
				'is_admin' => 0,
				'activated' =>1
			)
		);

		// inserts the data
		User::insert($users);
		
	}


}