<?php

class BlogsTableSeeder extends Seeder{


	public function run(){

		//deletes all info
		DB::table('blogs')->delete();

        $faker = Faker\Factory::create();
       
        $users = User::all();

        $array = [2,3];
        foreach($users as $user){

           Blog::create([
                'user_id'       => $user->id,
                'title'         => "Blog of user: {$user->id}",
                'description'   => $faker->paragraph(),
                'type_id'       => 1 ,
                'avatar'        => 'http://lorempixel.com/400/200'
                ]);
        }

        for ($i=0; $i < 100; $i++) { 

           $user = User::orderByRaw("RAND()")->first();


           Blog::create([
                'user_id'       => $user->id,
                'title'         => $faker->sentence(),
                'description'   => $faker->paragraph(),
                'type_id'       => $array[array_rand($array)]  ,
                'avatar'        => 'http://lorempixel.com/400/200'
            ]);
        }

	}

}