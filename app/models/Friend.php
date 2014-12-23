<?php

class Friend extends Eloquent{

	protected $table = 'friends';
	public $timestamps = false;

	public function user(){
		return $this->belongsTo('User', 'id', 'user_two');
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
		->where('status', '=', Config::get('social.friend_status.friends_got_request'))
		->take($limit)
		->get();
	}

	static function friendsList($id){
		return Friend::where('user_one', '=', $id)
				->join('users', 'user_two', '=', 'users.id')
				->where('status', '=', Config::get('social.friend_status.friends'))
				->get();

	}


}