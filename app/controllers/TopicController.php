<?php

class TopicController extends BaseController {
    
        private $topic;
        private $errors;
        
        function __construct() {
            parent::__construct();
        }
    
       /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        if(!Auth::user()->isHavePersonalBlog()){
            Auth::user()->createPersonalBlog();
        }

        $canPublishBlogs = array(0 => 'Мой персональный блог');
        foreach (Auth::user()->canPublishBlogs() as $blog) {
            $canPublishBlogs[$blog->id] = $blog->title;
        } 

        $topicType_list = TopicType::all();
        foreach($topicType_list as $Type){
            $type_list[$Type->id] = $Type->name; 
        }
		return View::make('topic.create', array(
                'canPublishBlogs' => $canPublishBlogs,
                'type_list' => $type_list,
            ));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = Topic::$rules;
		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){
                    return Redirect::back()->withErrors($validator);
                }
                
                $this->topic = $this->getTopic();
                $this->publishTopic(false);

                return Redirect::to('topic/show/'.$this->topic->id);
	}
        
        private function getTopic(){
            $topic = Topic::find($this->getTopicId());
            while(!$topic || !$topic->canEdit()){
                $topic = $this->createNewTopic();
            }
            return $topic;
        }
        
        private function getTopicId(){
            $topicId = null;
            if (!Input::has('topic_id')) {
                $topicId = $this->createNewTopic()->id;
            } else {
                $topicId = Input::get('topic_id');
            }
            return $topicId;
        }
        
        private function createNewTopic(){
            $topic = new Topic();
            $topic->type_id = Input::get('topic_type');
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
                $topic->increment('count_read');
                return View::make('topic.show', array('topic' => $topic));
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
            
            return View::make('topic.edit', array('user' => Auth::user(), 'topic' => $topic));
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
	public function destroy($id)
	{
		//
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
            return View::make('main.index', array('topics' => $topics));
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
            $this->topic->type_id = Input::get('topic_type');
            $this->topic->draft = $isDraft;
            $this->topic->save();

            $this->syncTopicTags(Input::get('tags'));
            $this->syncTopicRelations();
        }
}
