<?php

class BlogController extends BaseController {

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

	public function create(){
		return View::make('blog.create');
	}

	public function store(){
		$rules = array('title' => 'required', 'description' => 'required');
		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){
            return Redirect::to('blog/create')->withErrors($validator);
        }

        $blog = new Blog;
        $blog->title = Input::get('title');
        $blog->description = Input::get('description');
        $blog->user_id = Auth::user()->id;
        $blog->save();

        return Redirect::to('blog/all');
	}

	public function getAll(){
		$blogs = Blog::paginate('2');
		return View::make('blog.all',array('blogs' => $blogs));
	}

	public function getShow(){

	}

}
