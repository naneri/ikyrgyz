<?php

class Friend extends Eloquent{

	protected $connection = 'mysql_users';
	
	protected $table = 'friends';
	public $timestamps = false;

	public function user(){
		return $this->belongsTo('User', 'id', 'user_two');
	}
        
        static function toBan($userId){
            if(!Friend::where('user_one', Auth::id())->where('user_two', $userId)->exists()){
                Friend::insert(array(
                    array('user_one' => Auth::id(), 'user_two' => $userId, 'status' => Config::get('social.friend_status.banned')),
                    array('user_one' => $userId, 'user_two' => Auth::id(), 'status' => Config::get('social.friend_status.in_ban'))
                ));
            }else{
                Friend::where('user_one', Auth::id())->where('user_two', $userId)->update(['status' => Config::get('social.friend_status.banned')]);
                Friend::where('user_one', $userId)->where('user_two', Auth::id())->update(['status' => Config::get('social.friend_status.in_ban')]);
            }
        }
        
        static function fromBan($userId){
            if (Friend::where('user_one', Auth::id())->where('user_two', $userId)->where('status', Config::get('social.friend_status.banned'))->exists()
                    && Friend::where('user_one', $userId)->where('user_two', Auth::id())->where('status', Config::get('social.friend_status.in_ban'))->exists()) {
                Friend::where('user_one', Auth::id())->where('user_two', $userId)->update(['status' => Config::get('social.friend_status.friends')]);
                Friend::where('user_one', $userId)->where('user_two', Auth::id())->update(['status' => Config::get('social.friend_status.friends')]);
            }
        }

	
	/**
	 * Проверяет если юзеры уже друзья
	 * 
	 * @param  [type] $firstId  id первого юзера
	 * @param  [type] $secondId id второго юзера
	 * 
	 * @return [type]           [description]
	 */
	static function becomeFriends($firstId, $secondId){

		if(!Friend::where('user_one','=', $firstId)
			->where('user_two','=', $secondId)
			->where('status','=', Config::get('social.friend_status.friends'))
			->first())
		{
			Friend::insert(array(
				array('user_one' => $firstId, 	'user_two' => $secondId, 'status' =>  Config::get('social.friend_status.friends')),
				array('user_one' => $secondId, 'user_two' => $firstId, 	'status' =>  Config::get('social.friend_status.friends'))
				));
			return true;
		}

		return false;
	}

	/**
	 * Отправляет заявку на добавление в друзья
	 * 
	 * @param  [type] $firstId  id первого юзера
	 * @param  [type] $secondId id второго юзера
	 * 
	 * @return [type]           [description]
	 */
	static function requestFriend($firstId,$secondId){

		if(!Friend::where('user_one','=', $firstId)
			->where('user_two','=', $secondId)
			->first())
		{
			Friend::insert(array(
				array('user_one' => $firstId, 	'user_two' => $secondId, 'status' =>  Config::get('social.friend_status.friend_send_request')),
				array('user_one' => $secondId, 'user_two' => $firstId, 	'status' =>  Config::get('social.friend_status.friends_got_request'))
				));
			return true;
		}
		return false;
	}

	/**
	 * Подтверждает добавление в друзья
	 * 
	 * @param  [type] $firstId  id первого юзера
	 * @param  [type] $secondId id второго юзера
	 * 
	 * @return [type]           [description]
	 */
	static function submitFriend($firstId,$secondId){

		if(Friend::where('user_one', '=', $firstId)
			->where('user_two', '=', $secondId)
			->where('status','=', Config::get('social.friend_status.friends_got_request'))
			->first()
			)
		{

			// change the user friend status
			Friend::where('user_two', '=', $firstId)
			->where('user_one', '=', $secondId)
			->update(array('status' => Config::get('social.friend_status.friends')));

			//change the second user friend status
			Friend::where('user_two', '=', $secondId)
			->where('user_one', '=', $firstId)
			->update(array('status' => Config::get('social.friend_status.friends')));

			return true;
		}
		return false;
	}

	/**
	 * Получает список всех запросов на добавление в друзья
	 * 
	 * @param  [type]  $userId id пользователя 
	 * @param  integer $limit  [description]
	 * 
	 * @return [type]          [description]
	 */
	static function getFriendRequests($userId, $limit = 3){
		return Friend::where('user_one', '=', $userId)
		->join('users', 'user_two', '=', 'users.id')
		->join('user_description', 'user_two', '=', 'user_description.user_id')
		->where('status', '=', Config::get('social.friend_status.friends_got_request'))
		->take($limit)
		->get();
	}

	/**
	 * [friendsList description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	static function friendsList($id){
		return Friend::where('user_one', '=', $id)
				->join('users', 'user_two', '=', 'users.id')
                                ->join('user_description', 'user_description.user_id', '=', 'users.id')
				->where('status', '=', Config::get('social.friend_status.friends'))
				->get();

	}
        
        static function getFriendStatus($userOneId, $userTwoId){
            $friendRelation = Friend::where('user_one', $userOneId)
                            ->where('user_two', $userTwoId)
                            ->first();
            if($friendRelation){
                return $friendRelation->status;
            }
            return false;
        }

	static function removeFriend($firstId,$secondId){
		if(!Friend::where('user_one', '=', $firstId)){
			return false;
		}

		// change the user friend status
		Friend::where('user_two', '=', $firstId)
			->where('user_one', '=', $secondId)
			->update(array('status' => Config::get('social.friend_status.no_relation')));

		//change the second user friend status
		Friend::where('user_two', '=', $secondId)
			->where('user_one', '=', $firstId)
			->update(array('status' => Config::get('social.friend_status.no_relation')));

		return true;
	}

	/**
	 * Выясняет являются ли пользователи друзьями
	 * 
	 * @param  [type] $firstId  [description]
	 * @param  [type] $secondId [description]
	 * @return [type]           [description]
	 */
	static function checkIfFriend($firstId,$secondId){
		$x = Friend::where('user_one', '=', $firstId)->where('user_two', '=', $secondId)->first();
		if(isset($x->status) && ($x->status == Config::get('social.friend_status.friends'))){
			return True;
		}
       		return False;
	}
	
        public static function addCategory($categoryName){
            return Friend::insert(
                        array('user_one' => Auth::id(), 'user_two' => Auth::id(), 'category' => $categoryName)
                    );
        }
        
        public static function setCategory($friendId, $categoryName){
            return Friend::where('user_one', Auth::id())
                    ->where('user_two', $friendId)
                    ->update(['category' => $categoryName]);
        }
        
}