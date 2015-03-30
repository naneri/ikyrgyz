<?php


/**
 *	Класс ответственный за описание пользователя. Здесь не должно быть Insert-ов или Delete-ов, потому что строка с данными пользователя добавляется при создании юзера а удаляется при удалении юзера.
 */
class User_Description extends Eloquent{

	protected $connection = 'mysql_users';
	
	protected $table = 'user_description';

	public $timestamps = false;

	// обновление дополнительных данных пользователя.
	static function update_data($data){
		if(Input::hasFile('image')){
			$data['user_profile_avatar'] = User_Description::saveAvatar(Input::file('image'));
		}
		$description = User_Description::where('user_id', Auth::id())->update($data);

		return True;
	}

	// сохранение аватарки пользователя.
	static function saveAvatar($file){
		$destinationPath = 'images/user/' . Auth::id();
		if(!file_exists($destinationPath)){
				File::makeDirectory($destinationPath);
		}
		$extension = $file->getClientOriginalExtension();
		$fileName = time() . rand(1,100) .'.' . $extension;
		$file->move($destinationPath, $fileName);
		$avapath = URL::to('/') . '/' . $destinationPath .'/'. $fileName;
                $personalBlog = Auth::user()->getPersonalBlog();
                if($personalBlog){
                    $personalBlog->avatar = $avapath;
                    $personalBlog->save();
                }
		return $avapath;
	}

	public function user()
    {
        return $this->belongsTo('User');
    }
    
    public function checkAccess($accessColumn){
        $access = false;
        if(Auth::id() == $this->user_id || $this->$accessColumn == 'all'){
            $access = true;
        }else if($this->$accessColumn == 'friend'){
            $access = Friend::checkIfFriend($this->user_id, Auth::id());
        }
        return $access;
    }

}