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
		$rules = Blog::$rules;
		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){
                    return Redirect::to('blog/create')->withErrors($validator);
                }

                $blog = new Blog;
                $blog->title = Input::get('title');
                $blog->description = Input::get('description');
                $blog->blog_type_id = Input::get('blog_type_id');
                
                $blog->user_id = Auth::user()->id;
                $blog->save();

                return Redirect::to('blog/all');
	}

	public function getAll(){
		$blogs = Blog::paginate('3');
		return View::make('blog.all',array('blogs' => $blogs));
	}

	public function show($id){
		$blog = Blog::findOrFail($id);
                $blogTopics = $blog->topics;
                return View::make('blog.show', array('blog' => $blog, 'topics' => $blogTopics));
	}
        
        public function getEdit($id){
            $blog = Blog::findOrFail($id);
            return View::make('blog.edit', array('blog' => $blog));
        }
        
        public function postEdit($id){
		$rules = Blog::$rules;
                $validator = Validator::make(Input::all(), $rules);

                if ($validator->fails()) {
                    return Redirect::to('form')->withInput();
                }
                
                $blog = Blog::findOrFail($id);
                $blog->update(Input::except('_token'));
                
                return Redirect::to('blog/show/'.$blog->id);
        }

}
