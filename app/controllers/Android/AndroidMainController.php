<?php

class AndroidMainController extends BaseController {

    private $topic;

    public function __construct(){
        Auth::attempt(array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        ), false);
        parent::__construct();
    }
    public function androidIndex($page = 0){
        $rating = Config::get('topic.index_good_topic_rating');
        $topics = Topic::mainTopicQuery($page);
        return Response::json($topics, 200);
    }

    public function myBlogIds()
    {
        $canPublishBlogs = $this->getCanPublishBlogsForView();
        return Response::json($canPublishBlogs, 200);
    }

    public function androidAjaxTopics($sort, $page = 0){
        $rating = Config::get('topic.index_good_topic_rating');
        $offset = $page; // с какого начинать просмотр
        switch ($sort){
            case 'good':
                $topics = Topic::mainTopicQuery(0);
                break;
            case 'new':
                $topics = Topic::getTopicsByDate($offset);
                break;
            case 'top':
                $topics = Topic::getTopicsByRating($offset);
                break;
            default:
                $topics = Topic::mainTopicQuery($offset);
        }
        return Response::json($topics, 200);
    }

    public function androidNewTopics(){
        $topics = Topic::getTopicsByDate();
        return Response::json($topics, 200);
    }

    public function androidTopTopics() {
        $topics = Topic::getTopicsByRating();
        return Response::json($topics, 200);
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

    private function getBlogId(){
        return (Input::get('blog_id') == '0') ? Auth::user()->getPersonalBlog()->id : Input::get('blog_id');
    }

    public function androidCreateNewBlog() {
        $rules = Blog::$rules;
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            exit("validation_error");
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
            exit("ok");
        }
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

    public function androidCreateNewTopic() {
        $this->topic = $this->getTopic();


        $blogId = $this->getBlogId();

        if (!$this->topic->canEdit()) {
            exit("permission_denied");
        }

        $this->topic->title = Input::get('title');
        $this->topic->description = Input::get('description');
        $this->topic->blog_id = $blogId;
        $this->topic->user_id = Auth::user()->id;
        $this->topic->draft = false;
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

        exit("ok");
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

}
