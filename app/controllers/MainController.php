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

	public function index(){
		

		//$topics = User::find(1)->blogs()->join('Topics', 'blogs.id', '=', 'topics.blog_id');

		$topics = User::with(['blogs.topics' => function ($q) use (&$topics) {
		  	$topics = $q->get()->unique();
		}])->find(Auth::user()->id);

		$userId = Auth::user()->id;

		$topics2 = Topic::join('blogs', 'topics.blog_id', '=', 'blogs.id')
	     ->join('blog_subscriptions as us', function ($j) use ($userId) {
	        $j->on('us.blog_id', '=', 'blogs.id')
	          ->where('us.user_id', '=', $userId);
	      })->get(['topics.*']);


		//echo "<pre>"; print_r($topics); echo "</pre>";exit;
		return View::make('index', array('topics' => $topics2));
	}

}
