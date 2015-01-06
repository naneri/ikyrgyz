<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class RolesTableSeeder extends Seeder {

    public function run() {
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
                'name' => 'reader'
            ),
            array(
                'id' => 4,
                'name' => 'banned'
            ),
            array(
                'id' => 5,
                'name' => 'invite'
            ),
            array(
                'id' => 6,
                'name' => 'request'
            ),
            array(
                'id' => 7,
                'name' => 'reject'
            ),
        );

        DB::table('roles')->insert($roles);
    }

}
