<?php

class BlogController extends BaseController {

    function __construct() {
        parent::__construct();
    }

    /**
     * Страница создания блога
     * 
     * @return [type] [description]
     */
	public function create(){
            $blog_types = BlogType::all();
            $type_list = array();
            foreach($blog_types as $Type){
                switch($Type->name){
                    case 'open':
                        $type_list[$Type->id] = 'Открытый';
                        break;
                    case 'close':
                        $type_list[$Type->id] = 'Закрытый';
                        break;
                }
            }
        
            return View::make('blog.create', array('type_list' => $type_list));
	}

    /**
     * Сохранение блога в БД
     * @return [type] [description]
     */
	public function store(){

        // проводит валидацию данных
		$rules = Blog::$rules;
		$validator = Validator::make(Input::all(), $rules);

        // если валидация не проходит, то отправляет обратно на страницу создания блога
		if($validator->fails()){
            return Redirect::to('blog/create')->withErrors($validator);
        }
        
        $blogType = BlogType::find(Input::get('type_id'));
        if (!$blogType && $blogType->name == 'personal') {
            $blogType = BlogType::whereName('open')->first();
        }

        $blog = new Blog;
        $blog->title = Input::get('title');
        $blog->description = Input::get('description');
        $blog->type_id = $blogType->id;
        $blog->user_id = Auth::user()->id;
        
        if(Input::hasFile('avatar')){
            $dir = '/images/blog' . date('/Y/m/d/');
            do {
                $filename = str_random(30) . '.jpg';
            } while (File::exists(public_path() . $dir . $filename));

            Input::file('avatar')->move(public_path() . $dir, $filename);
            $blog->avatar = $dir.$filename;
        }
        
        if($blog->save()){
            $role = new BlogRole;
            $role->blog_id = $blog->id;
            $role->user_id = Auth::id();
            $role->role_id = 1;
            $role->save();
        }

    
        return Redirect::to('blog/all');
	}

    /**
     * Достаёт все блоги
     * @return [type] [description]
     */
	public function getAll(){
		$blogs = Blog::getMainBlogs();

		return View::make('blog.all',array('blogs' => $blogs));
	}

    /**
     * Метод для Ajax пагинации по блогам
     * @param  [int] $page страница
     * @return [html]      
     */
    public function ajaxBlogs($page){
        $blogs = Blog::getMainBlogs($page);
        return View::make('blog.build', array('blogs' => $blogs));
    }
    /**
     * Показывает страницу с описанием блога
     * 
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
	public function show($id){
            $blog = Blog::findOrFail($id);
            $topics = array();
            if($blog->canView()){
                $topics = Blog::getTopics($id);
            }
            $userRole = $blog->getUserRole();
            if(!isset($_COOKIE['ColumnN']))
            {
                $_COOKIE['ColumnN']='2';
            }
            return View::make('blog.show', compact('blog', 'topics', 'userRole'));
	}
    
    /**
     * Ajax пагинация для топиков в блоге
     * @param  [type] $id   ай-ди блога
     * @param  [type] $page страница
     * @return [type]       [description]
     */
    public function showAjax($id,$page){
        $topics = Blog::getTopics($id, $page);
        return View::make('topic.build', compact('topics'));
    }

	public function showPersonal($email) {
        $user = User::whereEmail($email)->get();
        $blog = $user->getPersonalBlog();
        return View::make('blog.show', array('blog' => $blog));
    }

    /**
     * Открывает страницу редактирования блога
     * 
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getEdit($id){
        $blog = Blog::findOrFail($id);
        return View::make('blog.edit', array('blog' => $blog));
    }
    
    /**
     * Изменяет блог
     * 
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
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
        if($blog->type->name == 'close'){
            $roleId = Role::whereName('request')->pluck('id');
        } else {
            $roleId = Role::whereName('reader')->pluck('id');
        }

        $blogRole = new BlogRole();
        $blogRole->blog_id = $blog->id;
        $blogRole->user_id = Auth::user()->id;
        $blogRole->role_id = $roleId;
        $blogRole->save();

        return Redirect::back();
    }

    public function readPersonalBlog($id) {
        $user = User::findOrFail($id);
        $blogId = $user->getPersonalBlog()->id;
        $this->readBlog($blogId);
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
