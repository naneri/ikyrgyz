<?php

class TopicController extends BaseController {
    
    private $topic;
    private $errors;
    
    function __construct() {
        parent::__construct();
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($type='topic')
	{

            // Достаём список блогов в которые может постить пользователь
            $canPublishBlogs = $this->getCanPublishBlogsForView();       
            if(!$canPublishBlogs){
                return Redirect::back()->with('message', [
                'type' => 'error', 
                'text' => 'Вам необходимо создать блог'
                ]);
            }

            return View::make('topic.create', array('canPublishBlogs' => $canPublishBlogs,'type_list' => $this->getTopicTypesForView(), 'type' => $type));
	}
        
        public function createLink(){
            return $this->create('link');
        }
        
    private function getCanPublishBlogsForView(){
        $canPublishBlogs = null;
        if (Auth::user()->isHavePersonalBlog()) {
            $canPublishBlogs[0] = Auth::user()->getPersonalBlog()->title;
        }
        foreach (Auth::user()->canPublishBlogs() as $blog) {
            $canPublishBlogs[$blog->id] = $blog->title;
        }
        return $canPublishBlogs;
    }
        
    private function getTopicTypesForView(){
        $topicType_list = TopicType::all();
        $forView = array();
        foreach ($topicType_list as $Type) {
            $forView[$Type->id] = $Type->name;
        }
        return $forView;
    }


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $blogIds = Auth::user()->canPublishBlogs()->lists('id');
        $blogIdsRegex = implode(',', $blogIds);
        $rules = Topic::$rules;
        $rules['blog_id'] = array('required', 'in:0,'.$blogIdsRegex);
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }
        $this->topic = $this->getTopic();
        $this->publishTopic(false);

        return Redirect::to('topic/show/'.$this->topic->id);
	}
        
    private function getTopic(){
        $topic = Topic::find(Input::get('topic_id'));
        if(!$topic || !$topic->canEdit()){
            $topic = $this->createNewTopic();
        }
        return $topic;
    }
    
    private function createNewTopic(){
        $topic = new Topic();
        $topic->type_id = 1;
        $topic->user_id = Auth::user()->id;
        $topic->blog_id = $this->getBlogId();
        $topic->save();
        return $topic;
    }
    
    private function getBlogId(){
        return (Input::get('blog_id') == '0') ? Auth::user()->getPersonalBlog()->id : Input::get('blog_id');
    }
    
    private function syncTopicRelations(){
        
        if (Input::has('photo_albums')){
            $this->topic->photoAlbums()->sync(Input::get('photo_albums'));
        }
        
        if (Input::has('photos')){
            $this->topic->photos()->sync(Input::get('photos'));
        }
        
        if (Input::has('audio_albums')){
            $this->topic->audioAlbums()->sync(Input::get('audio_albums'));
        }
        
        if (Input::has('audio')){
            $this->topic->audio()->sync(Input::get('audio'));
        }
    }
    
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
            $topic = Topic::findOrFail($id);
            $blog = $topic->blog;
            $isModerator = $topic->blog->isModeratorCurrentUser();
            $comments = $topic->commentsWithDataSortBy('old');
            $commentsSort = 'old';
            $creator = User::findOrFail($topic->user_id);
            $creator->description = User_Description::where('user_id', '=' ,$creator->id)->get()[0];
            $topic->increment('count_read');

            return View::make('topic.show', compact('topic', 'creator', 'blog', 'isModerator', 'comments', 'commentsSort'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
        $topic = Topic::findOrFail($id);
        
        if(!$topic->canEdit()){
            return View::make('error.permission', array('error' => 'permission denied'));
        }
        
        return View::make('topic.edit', array('user' => Auth::user(), 'topic' => $topic,'canPublishBlogs' => $this->getCanPublishBlogsForView(), 'type_list' => $this->getTopicTypesForView()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEdit($id) {
        
        $rules = Topic::$rules;
        
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $this->topic = $this->getTopic();
        $this->publishTopic(false);
        
        return Redirect::to('topic/show/'.$this->topic->id);
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{            
        $this->topic = $this->getTopic();
        $this->publishTopic(true);

        $this->syncTopicTags(Input::get('tags'));
        $this->syncTopicRelations();
        
        $result['topic_id'] = $this->topic->id;
        
        return Response::json($result);
    }
    
    private function syncTopicTags($tagsStr){
        $tags = array();
        foreach (explode(',', $tagsStr) as $tag_name) {
            $tag_name = trim($tag_name);
            if ($tag = Tag::where('name', '=', $tag_name)->first()) {
                $tag_id = $tag->id;
                $tags[] = $tag_id;
            } elseif (trim($tag_name) != '') {
                $tag_id = DB::table('tags')->insertGetId(array('name' => $tag_name));
                $tags[] = $tag_id;
            }
        }
        $this->topic->tags()->sync($tags);
    }
        
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		Topic::findOrFail($id)->delete();
        return Redirect::to('/');
	}

	public function uploadImage() {
        $rules = array('file' => 'required|image');

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(array('message' => $validator->messages()->first('file')));
        }

        $dir = '/images' . date('/Y/m/d/');

        do {
            $filename = str_random(30) . '.jpg';
        } while (File::exists(public_path() . $dir . $filename));

        Input::file('file')->move(public_path() . $dir, $filename);

        return Response::json(array('filelink' => $dir . $filename));
    }

    public function drafts(){
        $topics = Auth::user()->drafts();
        return View::make('topic.drafts', array('topics' => $topics));
    }
    
    private function publishTopic($isDraft){
        $blogId = $this->getBlogId();

        if (!$this->topic->canEdit()) {
            return View::make('error.permission', array('error' => 'permission denied'));
        }

        $this->topic->title = Input::get('title');
        $this->topic->description = Input::get('description');
        $this->topic->blog_id = $blogId;
        $this->topic->user_id = Auth::user()->id;
        $this->topic->draft = $isDraft;
        if(Input::has('topic_type')){
            $this->topic->type_id = TopicType::whereName(Input::get('topic_type'))->pluck('id');
        }
        if(Input::has('image_url')){
            $this->topic->image_url = Input::get('image_url');
        }
        if(Input::has('link_url')){
            $this->topic->meta = Input::get('link_url');
        }
        if (Input::hasFile('avatar')) {
            $new_name = str_random(15) . '.' . Input::file('avatar')->getClientOriginalExtension();
            Input::file('avatar')->move('images/' . $this->topic->blog_id . '/' . $this->topic->id, $new_name);
            $this->topic->image_url = URL::to('/') . '/images/' . $this->topic->blog_id . '/' . $this->topic->id . '/' . $new_name;
        }
        $this->topic->save();

        $this->syncTopicTags(Input::get('tags'));
        $this->syncTopicRelations();
    }
    
    public function fetchOG(){
        $rules = array('url' => 'required|url');

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json('error', 500);
        }
        
        $url = Input::get('url');
        $graph = OpenGraph::fetch($url);
        $data = array();
        if($graph){
            foreach($graph as $key => $value){
                $data[$key] = $value;
            }
        }else{
            $data['error'] = 'error get url meta data';
            return Response::json($data, 500);
        }
        return Response::json($data);
    }
    
    public function fetchContent(){
        $rules = array('url' => 'required|url');

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json('error', 500);
        }

        $url = Input::get('url');
        $html = file_get_contents($url);

        $Readability = new Readability($html, 'UTF-8'); // default charset is utf-8
        $ReadabilityData = $Readability->getContent();
        if(!$ReadabilityData['lead_image_url']){
            $ReadabilityData['lead_image_url'] = $Readability->getLeadImageUrlOfBody();
        }

        return Response::json($ReadabilityData);
    }
    
    public function postFavourite(){
        $result = array();
        
        $rules = array(
                'topic_id' => 'required|exists:topics,id'
            );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            $result['message'] = 'Error input data!';
            $result['status'] = 'error';
            return Response::json($result);
        }
        
        $topic = Topic::find(Input::get('topic_id'));
        
        if(!$topic->blog->canView()){
            $result['message'] = 'You cannot favourite this topic';
            $result['status'] = 'error';
            return Response::json($result);
        }
        
        $favourite = Favourite::where('target_type', 'topic')
                ->where('target_id', $topic->id)
                ->where('user_id', Auth::id())
                ->first();
        
        if($favourite){
            $favourite->delete();
            $result['message'] = 'Топик успешно удален из списка избранных';
            $result['action'] = 'remove';
        }else{
            Favourite::create(array(
                'target_type' => 'topic',
                'target_id' => $topic->id,
                'user_id' => Auth::id()
            ));
            $result['message'] = 'Топик успешно добавлен в список избранных';
            $result['action'] = 'add';
        }        
        $result['status'] = 'success';
        
        return Response::json($result);
    }

    public function getFavorites(){

        $topics = Topic::favoriteTopics(Auth::user()->id);
        
        JavaScript::put([
            'column'    => $_COOKIE['ColumnN'] ?: Config::get('social.main_column_count'),
            'ajaxPage'  => URL::to('topic/ajaxFavorites'),
            ]);

        return View::make('main.index', compact('topics'));
    }

    public function ajaxFavorites(){

        $topics = Topic::favoriteTopics(Auth::user()->id, Input::get('page'));

        return View::make('topic.build', array('topics' => $topics));
    }

    public function getTopicVideos(){

        $topics = Topic::videoTopics(Auth::user()->id);

        JavaScript::put([
            'column'    => $_COOKIE['ColumnN'] ?: Config::get('social.main_column_count'),
            'ajaxPage'  => URL::to('topic/ajaxVideos'),
            ]);
    
        return View::make('main.index', compact('topics'));

    }

    public function getAjaxVideos(){

        $topics = Topic::videoTopics(Auth::user()->id, Input::get('page'));
    
        return View::make('topic.build', compact('topics'));

    }

    public function getMyTopics(){
        $topics = Topic::userTopics(Auth::user()->id);

        JavaScript::put([
            'column'    => $_COOKIE['ColumnN'] ?: Config::get('social.main_column_count'),
            'ajaxPage'  => URL::to('topic/ajaxMyTopics'),
            ]);
    
        return View::make('main.index', compact('topics'));
    }

    public function ajaxMyTopics(){

        $topics = Topic::userTopics(Auth::user()->id, Input::get('page'));
    
        return View::make('topic.build', compact('topics'));

    }

    public function getLinkTopics(){

        $topics = Topic::linkTopics();
        JavaScript::put([
            'column'    => $_COOKIE['ColumnN'] ?: Config::get('social.main_column_count'),
            'ajaxPage'  => URL::to('topic/ajaxLinkTopics'),
            ]);
    
        return View::make('main.index', compact('topics'));
    }

    public function ajaxLinkTopics(){

        $topics = Topic::userTopics(Input::get('page'));
    
        return View::make('topic.build', compact('topics'));

    }

    public function addCover(){
        if(Input::get('removePhoto') == 1){
            Session::forget('topicCover');
            return Response::json(['status' => 'deleted']);
        }
        $input = Input::all();
        $rules = array(
            'file' => 'image|max:3000',
        );

        $validation = Validator::make($input, $rules);
        if ($validation->fails())
        {/*
            return Response::make($validation->errors->first(), 400);*/
            return Response::json(['error' => $validation->errors->first()]);
        }
       
        $image = Input::file('file');
        $filename  = time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('images/temp/' . $filename);
        Image::make($image->getRealPath())->save($path);

        Session::put('topicCover', $path);
        return Response::json(['status' => 'success', 'filename' => $filename]);
        
    }
}
