<?php

class User_Description extends Eloquent{

	protected $table = 'user_description';

	public $timestamps = false;

	static function saveAvatar(){
		$file = Input::file('image');
		$destinationPath = 'images/user/' . Auth::id();
		if(!file_exists($destinationPath)){
				File::makeDirectory($destinationPath);
		}
		$extension = Input::file('image')->getClientOriginalExtension();
		$fileName = time() . rand(1,100) .'.' . $extension;
		$file->move($destinationPath, $fileName);
		$avapath = $destinationPath . $fileName;
		$description = User_Description::where('user_id', Auth::id());
		$description->update(array('user_profile_avatar' => $avapath));
	}
}