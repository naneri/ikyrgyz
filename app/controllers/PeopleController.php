<?php

class PeopleController extends BaseController{

	/**
	 * Список всех пользователей соц.сети
	 * @return [type] [description]
	 */
	public function index(){

		//поиск по имейлу
		if(Input::get('email')){
			User::where('email', 'like', Input::get('email'));
		}else{
			$users = User::paginate(15);
		}
		
		return View::make('people.index', array('users' => $users));
	}

	/**
	 * запрос на добавление в друзья
	 * @return [type] [description]
	 */
	public function requestFriend($id){

		if(Auth::id() === $id){
			return Redirect::back()->with('message', "you can't be friend of yourself");
		}

		if(!Friend::becomeFriends(Auth::id(), $id)){
			return Redirect::back()->with('message', "some troubles :(");
		}
		
		return Redirect::back()->with('message', 'you are friends now');

	}


}