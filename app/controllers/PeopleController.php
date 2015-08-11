<?php

class PeopleController extends BaseController{


	public function __construct( NotificationRepository $notification){

		parent::__construct();

		$this->notification = $notification;

	}
	/**
	 * Список всех пользователей соц.сети
	 * @return [type] [description]
	 */
	public function index(){

		//поиск по имейлу
		if(!Input::get('email'))
		{
			$users = User::paginate(15);
		}
		
		return $this->makeView('people.index', array('users' => $users));
	}

	/**
	 * запрос на добавление в друзья
	 * @return [type] [description]
	 */
	public function requestFriend($id){

		if(Auth::id() == $id){
			return Redirect::back()->with('message', [
				'type' => 'error', 
				'text' => 'Вы не можете отправлять дружбу самому себе'
				]);
		}

		if(!Friend::requestFriend(Auth::id(), $id)){
			return Redirect::back()->with('message', [
				'type' => 'error', 
				'text' => 'Вы уже отправили этому пользователю запрос на дружбу'
				]);
		}
		
		$this->notification->newFriend(Auth::id(), $id);
		return Redirect::back()->with('message', [
				'type' => 'success', 
				'text' => 'Ваш запрос на дружбу отправлен'
				]);

	}

	/**
	 * Подтверждение добавления в друзья
	 * @param  integer $id id пользователя
	 * 
	 * @return [type]     [description]
	 */
	public function submitFriend($id){

	
		if(Auth::id() === $id){
			return Redirect::back()->with('message', [
				'type' => 'error', 
				'text' => 'Вы не можете отправлять дружбу самому себе'
				]);
		}

		if(!Friend::submitFriend(Auth::id(), $id)){
			return Redirect::back()->with('message', [
				'type' => 'error', 
				'text' => 'Вы уже друзья'
				]);
		}
		
		return Redirect::back()->with('message', [
			'type' => 'success', 
			'text' => 'Вы теперь друзья'
			]);
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
			return Redirect::back()->with('message', [
				'type' => 'error', 
				'text' => 'Вы не можете удалить себя из списка друзей' 
				]);
		}

		if(!Friend::removeFriend($current_user, $id)){
			return Redirect::back()->with('message', [
				'type' => 'error', 
				'text' => 'Появилась ошибка'
				]);
		}

		return Redirect::back()->with('message', [
			'type' => 'success', 
			'text' => 'Вы удалили пользователя из списка друзей'
			]);
	}

}