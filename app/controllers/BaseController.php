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

		$this -> configureLocale();
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

	public function setLocale($locale = Null)
    {
    	if(!$locale){
    		$mLocale = Config::get( 'app.locale' );
    	}
    	$locale = Config::get( 'app.locale' );
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
     * Detect and set application localization environment (language).
     * NOTE: Don't foreget to ADD/SET/UPDATE the locales array in app/config/app.php!
     *
     */
    private function configureLocale()
    {
        // Set default locale.
        $mLocale = Config::get( 'app.locale' );

        // Has a session locale already been set?
        if ( !Session::has( 'locale' ) )
        {
            // No, a session locale hasn't been set.
            // Was there a cookie set from a previous visit?
            $mFromCookie = Cookie::get( 'locale', null );
            if ( $mFromCookie != null && in_array( $mFromCookie, Config::get( 'app.locales' ) ) )
            {
                // Cookie was previously set and it's a supported locale.
                $mLocale = $mFromCookie;
            }
            else
            {
                // No cookie was set.
                // Attempt to get local from current URI.
                $mFromURI = Request::segment( 1 );
                if ( $mFromURI != null && in_array( $mFromURI, Config::get( 'app.locales' ) ) )
                {
                    // supported locale
                    $mLocale = $mFromURI;
                }
                else
                {
                    // attempt to detect locale from browser.
                    $mFromBrowser = substr( Request::server( 'http_accept_language' ), 0, 2 );
                    if ( $mFromBrowser != null && in_array( $mFromBrowser, Config::get( 'app.locales' ) ) )
                    {
                        // browser lang is supported, use it.
                        $mLocale = $mFromBrowser;
                    } // $mFromBrowser
                } // $mFromURI
            } // $mFromCookie

            Session::put( 'locale', $mLocale );
            Cookie::forever( 'locale', $mLocale );
        } // Session?
        else
        {
            // session locale is available, use it.
            $mLocale = Session::get( 'locale' );
        } // Session?

        // set application locale for current session.
        App::setLocale( $mLocale );

    }
}
