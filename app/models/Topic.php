<?php

class Topic extends Eloquent {
	
	protected $fillable = [];
	
	static function getSubscribedTopics($userId) {
		return Topic::join('blogs', 'topics.blog_id', '=', 'blogs.id')
		     ->join('blog_subscriptions as us', function ($j) use ($userId) {
		        $j->on('us.blog_id', '=', 'blogs.id')
		          ->where('us.user_id', '=', $userId);
		      })->get(['topics.*']);
	}
        
        public function tags() {
            return $this->belongsToMany('Tag');
        }
        
        public function images() {
            return $this->hasMany('TopicImage');
        }
        
        public function type(){
            return $this->belongsTo('TopicType', 'type_id');
        }
        
        public function video(){
            return $this->hasOne('TopicVideo');
        }
}