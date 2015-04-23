<?php

class AndroidController extends BaseController {

    public function __construct(){
        Auth::attempt(array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        ), false);
        parent::__construct();
    }
    public function androidIndex(){
        $rating = Config::get('topic.index_good_topic_rating');
        $topics = Topic::getSubscribedTopics(Auth::user()->id, $rating);
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
                $topics = Topic::getSubscribedTopics(Auth::user()->id, $rating, $offset);
                break;
            case 'new':
                $topics = Topic::getTopicsByDate($offset);
                break;
            case 'top':
                $topics = Topic::getTopicsByRating($offset);
                break;
            default:
                $topics = Topic::getSubscribedTopics(Auth::user()->id, $rating, $offset);
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
}
