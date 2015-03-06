<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public function __construct(){
		if(Auth::check()){
			Session::put('verify', 'FileManager4TinyMCE');
			// Отправляет в шаблон все запросы о добавлении в друзья
			$friend_requests = Friend::getFriendRequests(Auth::id());

			View::share('friend_requests', $friend_requests);
			// Отправляет в шаблон все новые сообщения
			$new_messages = Message::where('receiver_id', '=', Auth::id())->where('watched', '=', 0)->join('users', 'messages.sender_id', '=', 'users.id')->get();
			View::share('new_messages', $new_messages);


			// Отправляет в шаблон данные о пользователе
			$user_data = User::with('description')->find(Auth::id());
			View::share('user_data', $user_data);

		}

		// отправляет в шаблон базовый УРЛ сайта
		$base_config = array('base_url' => URL::to('/'));
		View::share('base_config', $base_config);


	}

}
