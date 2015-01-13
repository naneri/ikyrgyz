<?php

class TopicComment extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
            'text' => 'required',
            'topic_id' => 'required|exists:topics,id'
	];

	// Don't forget to fill this array
	protected $fillable = ['text', 'user_id', 'parent_id', 'topic_id'];
        
        public function childComments(){
            return $this->hasMany('TopicComment', 'parent_id');
        }
        
        public function user(){
            return $this->belongsTo('User');
        }
        
        public function topic(){
            return $this->belongsTo('Topic');
        }
        
        public function canDelete(){
            return 
                    Auth::user()->id == $this->user->id || 
                    $this->topic->blog->isModeratorCurrentUser();
        }
        
        public function isAuthor(){
            return Auth::user()->id == $this->user->id;
        }
        
        public function canView(){
            return
                !$this->trash ||
                Auth::user()->id == $this->user->id ||
                $this->topic->blog->isModeratorCurrentUser();
        }
        
        public function canRestore(){
            return $this->canDelete();
        }
}