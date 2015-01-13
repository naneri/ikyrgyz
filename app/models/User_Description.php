<?php


/**
 *	Класс ответственный за описание пользователя. Здесь не должно быть Insert-ов или Delete-ов, потому что строка с данными пользователя добавляется при создании юзера а удаляется при удалении юзера.
 */
class User_Description extends Eloquent{

	protected $connection = 'mysql_users';
	
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
		$avapath = URL::to('/') . '/' . $destinationPath .'/'. $fileName;
		$description = User_Description::where('user_id', Auth::id())->update(array('user_profile_avatar' => $avapath));
	}
}