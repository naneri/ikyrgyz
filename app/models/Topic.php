<?php

class Topic extends Eloquent {
	
	protected $fillable = [];
        
        public static $rules = array();
	
	static function getSubscribedTopics($userId, $rating, $offset) {
		return 	Topic::all();/*where('topics.rating', '>', $rating)
				->join('blogs', 'topics.blog_id', '=', 'blogs.id')
				->join('blog_subscriptions as us', function ($j) use ($userId){
		          	$j->on('us.blog_id', '=', 'blogs.id')
		            ->where('us.user_id', '=', $userId);
		        })
				->take(Config::get('topic.topics_per_page'))
				->offset($offset)
				->get(['topics.*']);*/
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
        
        public function images() {
            return $this->hasMany('TopicImage');
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
        
        public function comments(){
            return $this->hasMany('TopicComment');
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
            return $this->blog->isAdminCurrentUser();
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
            $this->rating += $iDeltaRating;

            if ($iValue == 1) {
                $this->increment('vote_up');
            } elseif ($iValue == -1) {
                $this->increment('vote_down');
            }
            
            return $iDeltaRating;
        }
}