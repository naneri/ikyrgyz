<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SubscriptionStatusSeederTableSeeder extends Seeder {

	public function run()
	{
		DB::table('subscription_statuses')->delete();
                
                $status = array(
                    array(
                        'id' => 1,
                        'name' => 'read'
                    ),
                    array(
                        'id' => 2,
                        'name' => 'invite'
                    ),
                    array(
                        'id' => 3,
                        'name' => 'request'
                    ),
                    array(
                        'id' => 4,
                        'name' => 'reject'
                    ),
                );
                
                DB::table('subscription_statuses')->insert($status);
	}

}