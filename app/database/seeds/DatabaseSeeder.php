<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		 $this->call('UsersTableSeeder');
		 $this->call('BlogTypesTableSeeder');
		 $this->call('BlogsTableSeeder');
		 $this->call('TopicsTableSeeder');
		 $this->call('BlogsSubscriptionsTableSeeder');
		 $this->call('TagsTableSeeder');
		 $this->call('TopicImagesTableSeeder');
		 $this->call('TopicVideoTableSeeder');
		 $this->call('MessagesTableSeeder');
		 $this->call('FriendTableSeeder');
                 $this->call('TopicCommentsTableSeeder');
	}

}
