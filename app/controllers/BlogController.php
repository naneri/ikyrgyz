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
                $blog->type_id = Input::get('type_id');
                
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
        
        public function getEditUsers($id){
            $blog = Blog::findOrFail($id);
            return View::make('blog.edit_users', array('blog' => $blog));
        }
        
        public function postEditUsers($id){
            
        }
        
        public function readBlog($id){
            $blog = Blog::findOrFail($id);
            
            if($blog->isHaveRelationWithUser()){
                return Redirect::back()->withMessage('You are already blog follower');
            }
            
            $subscriptionStatus = null;
            if($blog->type->name == 'close'){
                $subscriptionStatus = SubscriptionStatus::whereName('request')->first();
            } else {
                $subscriptionStatus = SubscriptionStatus::whereName('read')->first();
            }
            
            $blogSubscription = new BlogSubscription();
            $blogSubscription->blog_id = $blog->id;
            $blogSubscription->user_id = Auth::user()->id;
            $blogSubscription->status_id = $subscriptionStatus->id;
            $blogSubscription->save();
            
            return Redirect::back();
        }
        
        public function rejectBlog($id){
            $blog = Blog::findOrFail($id);

            if (!$blog->isHaveRelationWithUser()) {
                return Redirect::back()->withMessage('You are not blog follower');
            }

            $subscriptionStatus = SubscriptionStatus::whereName('reject')->first();

            $blogSubscription = BlogSubscription::where('user_id', Auth::user()->id)->where('blog_id', $blog->id)->first();
            $blogSubscription->update(array('status_id' => $subscriptionStatus->id));

            return Redirect::back();
        }
        
        
        public function acceptInviteBlog($id) {
            $blog = Blog::findOrFail($id);

            if (!$blog->isHaveRelationWithUser()) {
                return Redirect::back()->withMessage('You are not invited');
            }

            $subscriptionStatus = SubscriptionStatus::whereName('read')->first();

            $blogSubscription = BlogSubscription::where('user_id', Auth::user()->id)->where('blog_id', $blog->id)->first();
            $blogSubscription->update(array('status_id' => $subscriptionStatus->id));

            return Redirect::back();
        }

        public function refollowBlog($id){
            $blog = Blog::findOrFail($id);

            if (!$blog->isHaveRelationWithUser()) {
                return Redirect::back()->withMessage('You are not blog follower');
            }

            $subscriptionStatus = null;
            if ($blog->type->name == 'close') {
                $subscriptionStatus = SubscriptionStatus::whereName('request')->first();
            } else {
                $subscriptionStatus = SubscriptionStatus::whereName('read')->first();
            }
            
            $blogSubscription = BlogSubscription::where('user_id', Auth::user()->id)->where('blog_id', $blog->id)->first();
            $blogSubscription->update(array('status_id' => $subscriptionStatus->id));

            return Redirect::back();
        }

}
