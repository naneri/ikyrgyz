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
        
        public function childCommentsWithUserData(){
            return $this->childComments()
                        ->join(Config::get('database.connections.mysql_users.database') . '.user_description', 'user_description.user_id', '=', 'topic_comments.user_id')
                        ->join(Config::get('database.connections.mysql_users.database') . '.users', 'users.id', '=', 'topic_comments.user_id');
        }

        public function childCommentsSortBy($sort) {
            $comments = array();
            switch ($sort) {
                case 'new':
                    $comments = $this->childCommentsWithUserData()->orderBy('created_at', 'DESC');
                    break;
                case 'rating':
                    $comments = $this->childCommentsWithUserData()->orderBy('rating', 'DESC');
                    break;
                case 'old':
                default:
                    $comments = $this->childCommentsWithUserData()->orderBy('created_at', 'ASC');
                    break;
            }
            return $comments->select('topic_comments.*', 'user_description.*', 'users.rating as author_rating')->get();
        }

        public function withUserData(){
            return $this->join(Config::get('database.connections.mysql_users.database') . '.user_description', 'user_description.user_id', '=', 'topic_comments.user_id')
                        ->where('topic_comments.id', $this->id)
                        ->first();
        }

        public function parentWithUserData() {
            return $this->parent()->join(Config::get('database.connections.mysql_users.database') . '.user_description', 'user_description.user_id', '=', 'topic_comments.user_id')->first();
        }

        public function user(){
            return $this->belongsTo('User');
        }

        public function parent() {
            return $this->belongsTo('TopicComment', 'parent_id', 'id');
        }

        public function userDescription(){
            return $this->belongsTo('User_Description', 'user_id', 'user_id');
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
        
        public function vote($iValue){
            $this->rating += $iValue;
            if ($iValue == 1) {
                $this->increment('vote_up');
            } elseif ($iValue == -1) {
                $this->increment('vote_down');
            }
            return $iValue;
        }
}