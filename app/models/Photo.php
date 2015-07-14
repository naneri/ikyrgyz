<?php

class Photo extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
            'image' => 'required|image',
            'name' => 'string'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'url', 'user_id', 'album_id'];
        
        protected $connection = 'mysql_users';
        
        public function album(){
            return $this->belongsTo('PhotoAlbum', 'album_id');
        }

        public function canEdit() {
            return Auth::id() == $this->user_id;
        }
        
        public function canView(){
            return $this->album->canView();
        }
        
        public function getRatingAttribute($value){
            return round($value, 2);
        }
        
        public function comments(){
            return $this->hasMany('PhotoComment');
        }

        public function commentsWithData() {
            return $this->comments()
                            ->join('user_description', 'user_description.user_id', '=', 'photo_comments.user_id')
                            ->join('users', 'users.id', '=', 'photo_comments.user_id');
        }

        public function commentsWithDataSortBy($sort) {
            $comments = array();
            switch ($sort) {
                case 'new':
                    $comments = $this->commentsWithData()->orderBy('created_at', 'DESC');
                    break;
                case 'rating':
                    $comments = $this->commentsWithData()->orderBy('rating', 'DESC');
                    break;
                case 'old':
                default:
                    $comments = $this->commentsWithData()->orderBy('created_at', 'ASC');
                    break;
            }
            $commentsSelected = $comments->select('photo_comments.*', 'user_description.*', 'users.rating as author_rating')->get();
            $bonusRating = new BonusRating();
            foreach ($commentsSelected as &$v) {
                $v->author_rating += $bonusRating->getUsersBonusRating($v->user_id);
            }
            return $commentsSelected;
        }

        public function vote($iValue) {
            $this->rating += $iValue;
            if ($iValue == 1) {
                $this->increment('vote_up');
            } elseif ($iValue == -1) {
                $this->increment('vote_down');
            }
            return $iValue;
        }

}