<?php


/**
 *	Класс ответственный за описание пользователя. Здесь не должно быть Insert-ов или Delete-ов, потому что строка с данными пользователя добавляется при создании юзера а удаляется при удалении юзера.
 */
class User_Description extends Eloquent{

	protected $connection = 'mysql_users';
	
	protected $table = 'user_description';
 
    protected $guarded = array();
    
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
    
    public function birthdayInfo() {
        $age = date_diff(date_create($this->birthday), date_create('today'))->y;
        return Date::parse($this->birthday)->format('j F')." ($age лет)";
    }
    
    public function age(){
        $age = (int)date_diff(date_create($this->birthday), date_create('today'))->y;
        if($age>0 && $age<200){
            return $age;
        }
        return false;
    }

    public static function updateProfile($data, $user_id){

        $user['liveplace_country_id']   = Country::where('name_ru', $data['live_country'])->first()->id;
        $user['liveplace_city_id']      = City::where('name_ru', $data['live_city'])->first()->id;
        $user['birthplace_country_id']  = Country::where('name_ru', $data['birth_country'])->first()->id;
        $user['birthplace_city_id']     = City::where('name_ru', $data['birth_city'])->first()->id;
        $user['first_name']             = $data['first_name'];
        $user['last_name']              = $data['last_name'];
        $user['gender']                 = $data['gender'];


        User_Description::where('user_id', $user_id)->update($user);

        return True;
    }
}