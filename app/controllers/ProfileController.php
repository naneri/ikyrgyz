<?php

class ProfileController extends BaseController {

	/**
	 * Страница с профилем пользователя
	 * 
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getShow($id){
		$user = User::find($id);
		$friend_status = False;
		if(Friend::checkIfFriend($id, Auth::id())){
			$friend_status = True;
		}

		return View::make('profile.show', array('user' => $user, 'friend_status' => $friend_status));
	}

	/**
	 * Страница редактирования профиля
	 * 
	 * @return [type] [description]
	 */
	public function getEdit(){
		$user = User::find(Auth::id());
		return View::make('profile.edit', array('user' => $user));
	}

	/**
	 * Обработка post запроса редактирования профиля
	 * 
	 * @return [type] [description]
	 */
	public function postEdit(){
		$user = User::find(Auth::id());
		$file = Input::file('image');
		$result = User_Description::saveAvatar();
		return Redirect::back();
	}

	/**
	 * Список друзей пользователя
	 * 
	 * @return [type] [description]
	 */
	public function friends(){
		$friends = Friend::friendsList(Auth::id());
		return View::make('profile.friends', array('friends' => $friends));
	}
}