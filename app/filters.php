<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
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

    if(!isset($_COOKIE['ColumnN']))
    {
       $_COOKIE['ColumnN']='2';
    }

    View::share('template', Config::get('app.template') . '.');
    JavaScript::put(['logged' => Auth::check()]);
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});

Route::filter('notauth',function(){
	if(Auth::check()){
        return Redirect::to('main/index');
    }
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

Route::filter('no-description',function()
{

    // if(Auth::guest())
    // {
    //     return Response::make('Unauthorized', 401);
    // }
    // if(Auth::user()->noDescription())
    // {
    //     return Redirect::to('profile/fill');
    // }
});
/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

// Extending Validation
Validator::extend('gRecaptchaVerify', function ($attribute, $captchaValue, $parameters) {
    $secretKey = Config::get('social.google-recaptcha-secret-key');
    $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $captchaValue . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);
    return $response['success'] == true;
});