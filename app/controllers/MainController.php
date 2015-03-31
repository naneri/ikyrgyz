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
        $rating = Config::get('topic.index_good_topic_rating');
		$topics = Topic::getSubscribedTopics(Auth::user()->id, $rating);
        //echo "<pre>"; print_r($topics); echo "</pre>";exit;

        if(!isset($_COOKIE['ColumnN']))
        {
            $_COOKIE['ColumnN']='2';
        }
        return View::make('main.index', array('topics' => $topics));
	}

	public function ajaxTopics($sort, $page = 0){
            $rating = Config::get('topic.index_good_topic_rating');
            $offset = $page; // с какого начинать просмотр
            $topics = array();
            switch ($sort){
                case 'good':
                    $topics = Topic::getSubscribedTopics(Auth::user()->id, $rating, $offset);
                    break;
                case 'new':
                    $topics = Topic::getTopicsByDate($offset);
                    break;
                case 'top':
                    $topics = Topic::getTopicsByRating($offset);
                    break;
                default:
                    $topics = Topic::getSubscribedTopics(Auth::user()->id, $rating, $offset);
            }
            return View::make('topic.build', array('topics' => $topics));
	}
        
        public function newTopics(){
            $topics = Topic::getTopicsByDate();
            return View::make('main.index', array('topics' => $topics));
        }

        public function topTopics() {
            $topics = Topic::getTopicsByRating();
            return View::make('main.index', array('topics' => $topics));
        }

}
