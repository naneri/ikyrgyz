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
    
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');  
      DB::connection('mysql_users')->statement('SET FOREIGN_KEY_CHECKS=0;');       

      $this->call('CountryTableSeeder'); 
      $this->call('CityTableSeeder');   
      $this->call('UsersTableSeeder');
      $this->call('UserDescriptionTableSeeder');
      $this->call('FriendTableSeeder');
               
/*               $this->call('BlogTypesTableSeeder');
               $this->call('BlogsTableSeeder');
               $this->call('TopicTypesTableSeeder');
               $this->call('TopicsTableSeeder');
               $this->call('TagsTableSeeder');
               $this->call('TopicVideoTableSeeder');
               $this->call('MessagesTableSeeder');
               
               $this->call('TopicCommentsTableSeeder');
               $this->call('PhotoAlbumsTableSeeder');
               $this->call('PhotosTableSeeder');
               $this->call('AudioAlbumsTableSeeder');
               $this->call('AudioTableSeeder');
               $this->call('PhotoAlbumTopicTableSeeder');
               $this->call('PhotoTopicTableSeeder');
               $this->call('RolesTableSeeder');*/
              
               
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      DB::connection('mysql_users')->statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
