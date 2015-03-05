<?php

class BlogController extends BaseController {

    function __construct() {
        parent::__construct();
    }

	public function create(){
        $blog_types = BlogType::all();
        foreach($blog_types as $Type){
            $type_list[$Type->id] = $Type->name; 
        }
        
		return View::make('blog.create', array('type_list' => $type_list));
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
                    $dir = '/images/blog' . date('/Y/m/d/');
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
            $user = User::whereEmail($email)->get();
            $blog = $user->getPersonalBlog();
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
