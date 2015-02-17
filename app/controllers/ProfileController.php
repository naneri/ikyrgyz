<?php

class ProfileController extends BaseController {
    
        
        var $access = array('all' => 'Всем', 'friend' => 'Друзьям', 'me' => 'Только мне');

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
		$user = User::with('description')->find(Auth::id());
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
		$description_data = array('first_name' => Input::get('first_name'), 'last_name' => Input::get('last_name'), 'user_profile_about' => Input::get('about'));
		User_Description::update_data($description_data);
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
        
        public function getEditMain(){
            $user = User::with('description')->find(Auth::id());       
            return View::make('profile.edit.main', array('user' => $user, 'access' => $this->access));
        }
        
        public function postEditMain(){
		$description_data = Input::except(array('_token', 'day', 'month', 'year', 'image'));
                $description_data['birthday'] = Input::get('year').'-'.Input::get('month').'-'.Input::get('day');
                User_Description::update_data($description_data);
                return Redirect::back();
        }
}