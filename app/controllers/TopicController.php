<?php

class TopicController extends BaseController {
    
        private $user;
        
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
		return View::make('topic.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array('title' => 'required');
		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){
                    return Redirect::to('topic/create')->withErrors($validator);
                }
                
                $topic = Topic::find(Input::get('topic_id'));
                $topic->title = Input::get('title');
                $topic->description = Input::get('description');
                $topic->blog_id = 1;
                $topic->user_id = $this->user->id;
                $topic->type_id = TopicType::where('name', '=', Input::get('topic_type'))->first()->id;
                $topic->save();
                $topic_id = $topic->id;

                $this->syncTopicTags($topic, Input::get('tags'));                        
                
                switch(Input::get('topic_type')){
                    case "text":
                        break;
                    case "image":
                        $images = Input::get('topic_images');
                        $this->storeTopicImages($topic_id, $images);
                        break;
                    case "video":
                        $this->storeTopicVideo($topic_id, Input::get('video_url'), Input::get('video_embed_code'));
                        break;
                    case "music":
                        break;
                    case "link":
                        break;
                    case "polling":
                        break;
                    case "events":
                        break;
                }
                
                return Redirect::to('main/index');
	}
        
        private function storeTopicImages($topic_id, $images){
            foreach ($images as $image){
                TopicImage::create(array(
                    'topic_id' => $topic_id,
                    'url' => $image
                ));
            }
        }
        
        private function storeTopicVideo($topic_id, $video_url, $video_embed_code){
            TopicVideo::create(array(
                'topic_id' => $topic_id,
                'url' => $video_url,
                'embed_code' => $video_embed_code
            ));
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
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
            $rules = array();
            
            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {
                return Response::json(array('message' => $validator->messages()));
            }
            
            $result = array();
            $topicId = null;
            
            if(!Input::has('topic_id')){
                $topicId = DB::table('topics')
                    ->insertGetId(
                    array(
                        'type_id' => TopicType::where('name', '=', 'draft')->first()->id,
                        'user_id' => $this->user->id,
                        'blog_id' => Blog::where('user_id', '=', $this->user->id)->first()->id)
                    );
                $result['topic_id'] = $topicId;
            } else {
                $topicId = Input::get('topic_id');
            }
            
            $topic = Topic::find($topicId);
            $topic->title = Input::get('title');
            $topic->description = Input::get('description');
            $topic->save();
            
            $this->syncTopicTags($topic, Input::get('tags'));
            
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

}
