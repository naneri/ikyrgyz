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
			return Redirect::back()->with('message', '<div class="b-message b-message-error"><a href="javascript: $(`.b-message`).remove()" class="b-message-close"></a><div class="b-message-icon b-message-error-icon"></div><p class="b-message-p">Вы не можете отправлять дружбу самому себе</p></div>');
		}

		if(!Friend::requestFriend(Auth::id(), $id)){
			return Redirect::back()->with('message', '<div class="b-message b-message-error"><a href="javascript: $(`.b-message`).remove()" class="b-message-close"></a><div class="b-message-icon b-message-error-icon"></div><p class="b-message-p">Вы уже отправили этому пользователю запрос на дружбу</p></div>');
		}
		
		return Redirect::back()->with('message', '<div class="b-message b-message-success"><a href="javascript: $(`.b-message`).remove()" class="b-message-close"></a><div class="b-message-icon b-message-success-icon"></div><p class="b-message-p">Ваш запрос на дружбу отправлен</p></div>');

	}

	/**
	 * Подтверждение добавления в друзья
	 * @param  integer $id id пользователя
	 * 
	 * @return [type]     [description]
	 */
	public function submitFriend($id){

	
		if(Auth::id() === $id){
			return Redirect::back()->with('message', '<div class="b-message b-message-error"><a href="javascript: $(`.b-message`).remove()" class="b-message-close"></a><div class="b-message-icon b-message-error-icon"></div><p class="b-message-p">Вы не можете отправлять дружбу самому себе</p></div>');
		}

		if(!Friend::submitFriend(Auth::id(), $id)){
			return Redirect::back()->with('message', '<div class="b-message b-message-error"><a href="javascript: $(`.b-message`).remove()" class="b-message-close"></a><div class="b-message-icon b-message-error-icon"></div><p class="b-message-p">Вы уже друзья</p></div>');
		}
		
		return Redirect::back()->with('message', '<div class="b-message b-message-success"><a href="javascript: $(`.b-message`).remove()" class="b-message-close"></a><div class="b-message-icon b-message-success-icon"></div><p class="b-message-p">Вы теперь друзья</p></div>');
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
			return Redirect::back()->with('message', '<div class="b-message b-message-error"><a href="javascript: $(`.b-message`).remove()" class="b-message-close"></a><div class="b-message-icon b-message-error-icon"></div><p class="b-message-p">Вы не можете удалить себя из списка друзей</p></div>');
		}

		if(!Friend::removeFriend($current_user, $id)){
			return Redirect::back()->with('message', '<div class="b-message b-message-error"><a href="javascript: $(`.b-message`).remove()" class="b-message-close"></a><div class="b-message-icon b-message-error-icon"></div><p class="b-message-p">Появилась ошибка</p></div>');
		}

		return Redirect::back()->with('message', '<div class="b-message b-message-success"><a href="javascript: $(`.b-message`).remove()" class="b-message-close"></a><div class="b-message-icon b-message-success-icon"></div><p class="b-message-p">Вы удалили пользователя из списка друзей</p></div>');
	}

}