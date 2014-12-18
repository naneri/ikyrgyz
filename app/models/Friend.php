<?php

class Friend extends Eloquent{

	protected $table = 'friends';

	/**
	 * Проверяет если юзеры уже друзья
	 * @param  [type] $firstId  id первого юзера
	 * @param  [type] $secondId id второго юзера
	 * @return [type]           [description]
	 */
	static function becomeFriends($firstId, $secondId){

		if(!Friend::where('user_from','=', $firstId)
			->where('user_to','=', $secondId)
			->where('status','=', Config::get('social.friend_status.friends'))->first())
		{
			Friend::insert(array(
				array('user_from' => $firstId, 	'user_to' => $secondId, 'status' =>  Config::get('social.friend_status.friends')),
				array('user_from' => $secondId, 'user_to' => $firstId, 	'status' =>  Config::get('social.friend_status.friends'))
				));
			return true;
		}

		return false;
	}
}