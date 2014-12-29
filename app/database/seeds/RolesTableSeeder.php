<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class RolesTableSeeder extends Seeder {

	public function run()
	{
            DB::table('roles')->delete();
            
            $roles = array(
                array(
                    'id' => 1,
                    'name' => 'admin'
                ),
                array(
                    'id' => 2,
                    'name' => 'moderator'
                ),
                array(
                    'id' => 3,
                    'name' => 'regular'
                )
            );
            
            DB::table('roles')->insert($roles);
            
	}

}