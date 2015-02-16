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
                $this->call('TopicTypesTableSeeder');
                $this->call('TopicsTableSeeder');
                $this->call('TagsTableSeeder');
                $this->call('TopicVideoTableSeeder');
                $this->call('MessagesTableSeeder');
                $this->call('FriendTableSeeder');
                $this->call('TopicCommentsTableSeeder');
                $this->call('PhotoAlbumsTableSeeder');
                $this->call('PhotosTableSeeder');
                $this->call('AudioAlbumsTableSeeder');
                $this->call('AudioTableSeeder');
                $this->call('PhotoAlbumTopicTableSeeder');
                $this->call('PhotoTopicTableSeeder');
                $this->call('RolesTableSeeder');
                $this->call('UserDescriptionTableSeeder');
                $this->call('CitiesTableSeeder');
                $this->call('CountriesTableSeeder');
    }

}
