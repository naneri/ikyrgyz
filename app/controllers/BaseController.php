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


		if(Auth::check() && !Request::ajax()){
			Session::put('verify', 'FileManager4TinyMCE');

            

			// Отправляет в шаблон все запросы о добавлении в друзья
			$friend_requests = Friend::getFriendRequests(Auth::id());

			View::share('friend_requests', $friend_requests);
			// Отправляет в шаблон все новые сообщения
			$new_messages = Message::where('receiver_id', '=', Auth::id())->where('watched', '=', 0)->join('users', 'messages.sender_id', '=', 'users.id')->join('user_description', 'messages.sender_id', '=', 'user_description.user_id')->select('messages.*', 'user_description.*')->get();
			View::share('new_messages', $new_messages);


			// Отправляет в шаблон данные о пользователе
			$user_data = User::with('description')->find(Auth::id());
			View::share('user_data', $user_data);

            $topic_number = Auth::user()->topicNumber();

            View::share('topic_number', $topic_number);

            $friend_number = Auth::user()->friends()->count();

            View::share('friend_number', $friend_number);

            $favorites = Favourite::where('user_id', Auth::user()->id)->where('target_type', 'topic')->count();

            View::share('favorites', $favorites);

           /* $notes =  NotificationRepository::getAllNotifications(Auth::id());*/


          /*  echo "<pre>"; print_r(NotificationRepository::getAllNotifications(Auth::id())); echo "</pre>";exit;*/
/*
echo "<pre>"; print_r($notes); echo "</pre>";exit;*/
          /*  View::share('notes', $notes);*/

            /*echo "<pre>"; print_r($notes); echo "</pre>";exit;
            foreach($notes as $note){
                echo Lang::choice($note->lang_message, $note->total) . '|' . $note->column . '<br>';
            }
            exit;*/
		}

        // отправляет в шаблон базовый УРЛ сайта
        JavaScript::put(['base_url' => URL::to('/')]);

		// отправляет в шаблон базовый УРЛ сайта
		$base_config = array('base_url' => URL::to('/'));

		View::share('base_config', $base_config);

	}

    /**
     * Смена языка пользователя
     * 
     * @param [string] $locale [язык]
     */
	public function setLocale($locale = Null)
    {
    	if(!$locale){
    		$mLocale = Config::get( 'app.locale' );
    	}
        $mLocale = $locale; // Get parameter from URL.
        if ( in_array( $mLocale , Config::get( 'app.locales' ) ) )
        {
           App::setLocale( $mLocale );
           Session::put( 'locale', $mLocale );
           Cookie::forever( 'locale', $mLocale );
        }
        return Redirect::back();
    }


    /**
     * Выбирает тему для шаблонов
     * 
     * @param  [string] $name   [Название темы]
     * @param  array    $params [Переменные для шаблона]
     * 
     * @return                  [Рендеринг шаблона]
     */
    public function makeView($name, $params = array()){
        $path = Config::get('app.template') . '.' . $name;

        return View::make($path, $params);
    }
}
