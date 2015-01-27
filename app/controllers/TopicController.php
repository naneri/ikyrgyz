<?php

class TopicController extends BaseController {
    
        private $user;
        private $topic;
        
        function __construct() {
            parent::__construct();
            $this->user = Auth::user();
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
                if(!$this->user->isHavePersonalBlog()){
                    $this->user->createPersonalBlog();
                }
		return View::make('topic.create', array('user' => $this->user));
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
                
                $topicId = $this->getTopicId();
                $blogId = $this->getBlogId();
                
                $topic = Topic::find($topicId);
                $this->topic = $topic;
                $topic->title = Input::get('title');
                $topic->description = Input::get('description');
                $topic->blog_id = $blogId;
                $topic->user_id = $this->user->id;
                $topic->type_id = TopicType::where('name', Input::get('topic_type'))->first()->id;
                $topic->draft = 0;
                $topic->save();
                $topic_id = $topic->id;

                $this->syncTopicTags($topic, Input::get('tags'));
                $this->syncTopicRelations();

                return Redirect::to('main/index');
	}
        
        private function getTopicId(){
            $topicId = null;
            if (!Input::has('topic_id')) {
                $topicId = DB::table('topics')
                    ->insertGetId(
                    array(
                        'type_id' => TopicType::where('name', Input::get('topic_type'))->first()->id,
                        'user_id' => $this->user->id,
                        'blog_id' => Blog::where('user_id', $this->user->id)->first()->id,
                        'draft' => 1)
                );
            } else {
                $topicId = Input::get('topic_id');
            }
            return $topicId;
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
            
            return View::make('topic.edit', array('user' => $this->user, 'topic' => $topic));
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

            $topic = Topic::findOrFail($id);
            
            if (!$topic->canEdit()) {
                return View::make('error.permission', array('error' => 'permission denied'));
            }
            
            $this->topic = $topic;
            $topic->title = Input::get('title');
            $topic->description = Input::get('description');
            $topic->blog_id = Input::get('blog_id');
            $topic->save();

            $this->syncTopicTags($topic, Input::get('tags'));
            $this->syncTopicRelations();

            return Redirect::to('topic/show/'.$id);
        }

        /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
            $result = array();
            
            $topicId = $this->getTopicId();
            $blogId = $this->getBlogId();
            
            $result['topic_id'] = $topicId;
                        
            $topic = Topic::find($topicId);
            $this->topic = $topic;
            $topic->title = Input::get('title');
            $topic->description = Input::get('description');
            $topic->blog_id = $blogId;
            $topic->save();
            
            $this->syncTopicTags($topic, Input::get('tags'));
            $this->syncTopicRelations();
            
            return Response::json($result);
        }
        
        private function syncTopicTags($topic, $tagsStr){
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
            $topic->tags()->sync($tags);
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
}
