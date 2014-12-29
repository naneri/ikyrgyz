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

		if(Auth::id() == $id){
			return Redirect::back()->with('message', "you can't be friend of yourself");
		}

		if(!Friend::requestFriend(Auth::id(), $id)){
			return Redirect::back()->with('message', "some troubles :(");
		}
		
		return Redirect::back()->with('message', 'your request have been sent');

	}

	/**
	 * Подтверждение добавления в друзья
	 * @param  integer $id id пользователя
	 * 
	 * @return [type]     [description]
	 */
	public function submitFriend($id){

	
		if(Auth::id() === $id){
			return Redirect::back()->with('message', "you can't be friend of yourself");
		}

		if(!Friend::submitFriend(Auth::id(), $id)){
			return Redirect::back()->with('message', "some troubles :(");
		}
		
		return Redirect::back()->with('message', 'you are now friends');
	}

	/**
	 * Удаление из друзей
	 * 
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function removeFriend($id){

		$current_user = Auth::id();

		if($current_user === $id){
			return Redirect::back()->with('message', "you can't unfriend yourself");
		}

		if(!Friend::removeFriend($current_user, $id)){
			return Redirect::back()->with('message', 'some troubles');
		}

		return Redirect::back()->with('message', 'you have removed a friend');
	}

}