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

	public function index($sort = 'id'){
        $rating = Config::get('topic.index_good_topic_rating');

		$topics = Topic::getMainTopics($rating, $sort);

        $topic_number = Auth::user()->topicNumber();

        $friend_number = Friend::where('user_one', Auth::user()->id)->count();

        JavaScript::put([
            'sort'      => $sort,
            'column'    => $_COOKIE['ColumnN'] ?: Config::get('social.main_column_count')
            ]);

        return View::make('main.index', compact('topics', 'topic_number', 'friend_number'));
	}

	public function ajaxTopics($sort, $offset = 0){

        $rating = Config::get('topic.index_good_topic_rating');

        $topics = Topic::getMainTopics($rating, $sort, $offset);

        return View::make('topic.build', array('topics' => $topics));

	}

}
