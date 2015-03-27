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

}