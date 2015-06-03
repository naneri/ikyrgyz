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

        JavaScript::put([
            'sort'      => $sort,
            'column'    => $_COOKIE['ColumnN'] ?: Config::get('social.main_column_count'),
            'ajaxPage'  => URL::to('main/ajaxTopics'),
            ]);

        return View::make('main.index', compact('topics'));
	}

	public function ajaxTopics(){

        $rating = Config::get('topic.index_good_topic_rating');

        $topics = Topic::getMainTopics($rating, Input::get('sort'), Input::get('page'));

        return View::make('topic.build', array('topics' => $topics));

	}

    public function getEmailTemplate(){
        return View::make('emails.layout');
    }

}
