<?php

class BlogRole extends \Eloquent {

	protected $fillable = ['blog_id', 'user_id','role_id'];

  	protected $connection = 'mysql';


    public static function createOwner($blog_id, $user_id){


		self::create([
			'blog_id' 	=> $blog_id,
			'user_id'	=> $user_id,
			'role_id'	=> 1
			]);

	}

    public static function addUser($blog_id, $user_id, $role_id){

		self::create([
			'blog_id' => $blog_id,
			'user_id' => $user_id,
			'role_id' => $role_id	
			]);

	}


	public static function refollow($blog_id, $user_id, $role_id){

		$blogRole = getRole($blog->id, Auth::id());

		$blogRole->role_id = $role_id;

        $blogRole->save();

	}


	public static function getRole($blog_id, $user_id){

		return Self::where(['blog_id' => $blog_id,
            				'user_id' => $user_id,
            			   ])->first();
	}
}