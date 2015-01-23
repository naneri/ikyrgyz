<?php

class MainController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index($id = 0){
		$offset = 2; // с какого начинать просмотр
        $rating = Config::get('topic.index_good_topic_rating');
		$topics = Topic::getSubscribedTopics(Auth::user()->id, $rating, $offset);
		return View::make('main.index', array('topics' => $topics));
	}

}
