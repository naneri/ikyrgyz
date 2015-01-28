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
                
                if(Input::hasFile('avatar')){
                    $dir = '/images' . date('/Y/m/d/');
                    do {
                        $filename = str_random(30) . '.jpg';
                    } while (File::exists(public_path() . $dir . $filename));

                    Input::file('avatar')->move(public_path() . $dir, $filename);
                    $blog->image = $dir.$filename;
                }
                
                $blog->save();

            
                return Redirect::to('blog/all');
	}

	public function getAll(){
		$blogs = Blog::paginate('3');
		return View::make('blog.all',array('blogs' => $blogs));
	}

	public function show($id){
		$blog = Blog::findOrFail($id);
                return View::make('blog.show', array('blog' => $blog));
	}
        
	public function showPersonal($email) {
            $userId = User::whereEmail($email)->pluck('id');
            $blog = Blog::join('blog_types', 'blog_types.id', '=', 'blogs.type_id')
                    ->where('blogs.user_id', $userId)
                    ->where('blog_types.name', 'personal')
                    ->select('blogs.*')
                    ->first();
            return View::make('blog.show', array('blog' => $blog));
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
            $blog = Blog::findOrFail($id);
            $users = Input::except('_token');
            
            foreach($users as $userId=>$role){
                $roleId = Role::whereName($role)->first()->id;
                $blogRole = BlogRole::where('blog_id', $blog->id)
                        ->where('user_id', $userId);
                $blogRole->update(array('role_id' => $roleId));
            }
            
            return View::make('blog.edit_users', array('blog' => $blog));
        }
        
        public function readBlog($id){
            $blog = Blog::findOrFail($id);
            
            if($blog->isUserHaveRole()){
                return Redirect::back()->withMessage('You are already blog follower');
            }
            
            $roleId = null;
            if($blog->type->name == 'open'){
                $roleId = Role::whereName('reader')->pluck('id');
            } else {
                $roleId = Role::whereName('request')->pluck('id');
            }
            
            $blogRole = new BlogRole();
            $blogRole->blog_id = $blog->id;
            $blogRole->user_id = Auth::user()->id;
            $blogRole->role_id = $roleId;
            $blogRole->save();
            
            return Redirect::back();
        }
        
        public function rejectBlog($id){
            $blog = Blog::findOrFail($id);

            if (!$blog->isUserHaveRole()) {
                return Redirect::back()->withMessage('You are not blog follower');
            }

            $roleId = Role::whereName('reject')->pluck('id');

            $blogRole = BlogRole::where('user_id', Auth::user()->id)->where('blog_id', $blog->id)->first();
            $blogRole->update(array('role_id' => $roleId));

            return Redirect::back();
        }
        
        
        public function acceptInviteBlog($id) {
            $blog = Blog::findOrFail($id);

            if (!$blog->isUserHaveRole()) {
                return Redirect::back()->withMessage('You are not invited');
            }

            $roleId = Role::whereName('reader')->pluck('id');

            $blogRole = BlogRole::where('user_id', Auth::user()->id)->where('blog_id', $blog->id)->first();
            $blogRole->update(array('role_id' => $roleId));

            return Redirect::back();
        }

        public function refollowBlog($id){
            $blog = Blog::findOrFail($id);

            if (!$blog->isUserHaveRole()) {
                return Redirect::back()->withMessage('You are not blog follower');
            }

            $roleId = null;
            if ($blog->type->name == 'open') {
                $roleId = Role::whereName('reader')->pluck('id');
            } else {
                $roleId = Role::whereName('request')->pluck('id');
            }

            $blogRole = BlogRole::where('user_id', Auth::user()->id)->where('blog_id', $blog->id)->first();
            $blogRole->blog_id = $blog->id;
            $blogRole->user_id = Auth::user()->id;
            $blogRole->role_id = $roleId;
            $blogRole->save();
        
            return Redirect::back();
        }

}
