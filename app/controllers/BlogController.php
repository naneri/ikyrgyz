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

            BlogRole::createOwner($blog->id, Auth::id());
            
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
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $blog = Blog::findOrFail($id);
        $blog->update(Input::except('_token'));

        return Redirect::to('blog/show/'.$blog->id);
    }
    
    public function getEditUsers($id){
        $blog = Blog::findOrFail($id);
        $blogUsers = $blog->getBlogUsers();
        return View::make('blog.edit_users', compact('blog', 'blogUsers'));
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
        
        return Redirect::to('blog/edit/'.$blog->id.'/users');
    }
    
    public function readBlog($id){
        $blog = Blog::findOrFail($id);
        
        if($blog->isUserHaveRole()){
            return Redirect::back()->withMessage('You are already blog follower');
        }
        
        $role_id = null;
        if($blog->type->name == 'close'){
            $role_id = Role::whereName('request')->pluck('id');
        } else {
            $role_id = Role::whereName('reader')->pluck('id');
        }

        BlogRole::addUser($blog->id, Auth::id(), $role_id);

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

        $blogRole = BlogRole::getRole('user_id', Auth::id());
        $blogRole->update(array('role_id' => $roleId));

        return Redirect::back();
    }

    public function refollowBlog($id){
        $blog = Blog::findOrFail($id);

        if (!$blog->isUserHaveRole()) {
            return Redirect::back()->withMessage('You are not blog follower');
        }

        $role_id = null;
        if ($blog->type->name == 'open') {
            $role_id = Role::whereName('reader')->pluck('id');
        } else {
            $role_id = Role::whereName('request')->pluck('id');
        }

        BlogRole::refollow($blog->id, Auth::id(), $role_id);
        
        return Redirect::back();
    }

    public function postFavourite() {
        $result = array();

        $rules = array(
            'blog_id' => 'required|exists:blogs,id'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            $result['message'] = 'Error input data!';
            $result['status'] = 'error';
            return Response::json($result);
        }

        $blog = Blog::find(Input::get('blog_id'));

        if (!$blog->canView()) {
            $result['message'] = 'You cannot favourite this topic';
            $result['status'] = 'error';
            return Response::json($result);
        }

        $favourite = Favourite::where('target_type', 'blog')
                ->where('target_id', $blog->id)
                ->where('user_id', Auth::id())
                ->first();

        if ($favourite) {
            $favourite->delete();
            $result['message'] = 'Блог успешно удален из списка избранных';
            $result['action'] = 'remove';
        } else {
            Favourite::create(array(
                'target_type' => 'blog',
                'target_id' => $blog->id,
                'user_id' => Auth::id()
            ));
            $result['message'] = 'Блог успешно добавлен в список избранных';
            $result['action'] = 'add';
        }
        $result['status'] = 'success';

        return Response::json($result);
    }

}
