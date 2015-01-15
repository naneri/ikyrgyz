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

			// Отправляет в шаблон все запросы о добавлении в друзья
			$friend_requests = Friend::getFriendRequests(Auth::id());
			View::share('friend_requests', $friend_requests);

			// Отправляет в шаблон все новые сообщения
			$new_messages = Message::where('receiver_id', '=', Auth::id())->where('watched', '=', 0)->join('users', 'messages.sender_id', '=', 'users.id')->get();
			View::share('new_messages', $new_messages);

			$user_data = User::where('id', '=', Auth::id());


		}



	}

}
