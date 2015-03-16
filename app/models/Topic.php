<?php

class Topic extends Eloquent {
	
	protected $fillable = [];
        
        public static $rules = array();

        static function getSubscribedTopics($userId, $rating, $offset = 0) {
            $topic_number = Config::get('topic.topics_per_page');
    		return 	Topic::with('blog', 'user', 'user.description')
                ->skip($offset*$topic_number)
                ->take($topic_number)
                ->orderBy('topics.id', 'DESC')
                ->get();/*where('topics.rating', '>', $rating)
                      ->join('blogs', 'topics.blog_id', '=', 'blogs.id')
                      ->join('blog_subscriptions as us', function ($j) use ($userId){
                      $j->on('us.blog_id', '=', 'blogs.id')
                      ->where('us.user_id', '=', $userId);
                      })
                      ->take($topic_number)
                      ->offset($offset)
        				->get(['topics.*']);*/
        }
        
        static function getTopicsByDate($offset = 0){
            $topicLimit = Config::get('topic.topics_per_page');
            $topics = Topic::join('blogs', 'blogs.id', '=', 'topics.blog_id')
                    ->join('blog_types', 'blog_types.id', '=', 'blogs.type_id')
                    ->where('topics.draft', '=', '0')
                    ->whereIn('blog_types.name', array('personal', 'open'))
                    ->orWhereIn('blogs.id', Auth::user()->canPublishBlogs()->lists('id'))
                    ->skip($offset*$topicLimit)
                    ->take($topicLimit)
                    ->orderBy('topics.created_at', 'DESC')
                    ->select('topics.*')
                    ->get();
            return $topics;
        }
        
        static function getTopicsByRating($offset = 0){
            $topicLimit = Config::get('topic.topics_per_page');
            $topics = Topic::join('blogs', 'blogs.id', '=', 'topics.blog_id')
                    ->join('blog_types', 'blog_types.id', '=', 'blogs.type_id')
                    ->where('topics.draft', '=', '0')
                    ->whereIn('blog_types.name', array('personal', 'open'))
                    ->orWhereIn('blogs.id', Auth::user()->canPublishBlogs()->lists('id'))
                    ->skip($offset * $topicLimit)
                    ->take($topicLimit)
                    ->orderBy('topics.rating', 'DESC')
                    ->orderBy('topics.created_at', 'DESC')
                    ->select('topics.*')
                    ->get();
            return $topics;
        }

        public function tags() {
            return $this->belongsToMany('Tag');
        }
        
        public function tagsToString(){
            $stringTags = '';
            foreach($this->tags as $tag){
                $stringTags .= $tag->name.', ';
            }
            return $stringTags;
        }
        
        public function type(){
            return $this->belongsTo('TopicType', 'type_id');
        }
        
        public function video() {
            return $this->hasOne('TopicVideo');
        }
        
        public function user(){
            return $this->belongsTo('User');
        }

        public function author() {
            return $this->belongsTo('User', 'user_id');
        }
        
        public function comments(){
            return $this->hasMany('TopicComment');
        }

        public function commentsChild($parentId = 0){
            return $this->hasMany('TopicComment')->where('parent_id', $parentId);
        }
        
        public function commentsWithData(){
            return $this->comments()
                    ->join(Config::get('database.connections.mysql_users.database').'.user_description','user_description.user_id','=','topic_comments.user_id');
        }

        public function commentsWithDataSortBy($sort) {
            $comments = array();
            switch($sort){
                case 'new':
                    $comments = $this->commentsWithData()->orderBy('created_at', 'DESC')->get();
                    break;
                case 'rating':
                    $comments = $this->commentsWithData()->orderBy('rating', 'DESC')->get();
                    break;
                case 'old':
                default:
                    $comments = $this->commentsWithData()->orderBy('created_at', 'ASC')->get();
                    break;
            }
            return $comments;
        }

        public function blog(){
            return $this->belongsTo('Blog');
        }
        
        public function photoAlbums(){
            return $this->belongsToMany('PhotoAlbum');
        }
        
        public function photos(){
            return $this->belongsToMany('Photo');
        }
        
        public function audioAlbums(){
            return $this->belongsToMany('AudioAlbum');
        }
        
        public function audio(){
            return $this->belongsToMany('Audio');
        }
        
        public function canEdit(){
            return $this->blog->isAdminCurrentUser() || $this->user_id == Auth::id() || Auth::user()->is_admin;
        }
        
        public function vote($iValue){
            /**
             * Устанавливаем рейтинг топика
             */
            $skill = Auth::user()->skill;
            $iDeltaRating = $iValue;
            if ($skill >= 100 and $skill < 250) {
                $iDeltaRating = $iValue * 2;
            } elseif ($skill >= 250 and $skill < 400) {
                $iDeltaRating = $iValue * 3;
            } elseif ($skill >= 400) {
                $iDeltaRating = $iValue * 4;
            }
            $iDeltaRating = round($iDeltaRating, 3);
            $this->rating += $iDeltaRating;

            if ($iValue == 1) {
                $this->increment('vote_up');
            } elseif ($iValue == -1) {
                $this->increment('vote_down');
            }
            
            return $iDeltaRating;
        }

        public function delete(){
            $this->video()->delete();
            $this->comments()->delete();
            return parent::delete();
        }
}