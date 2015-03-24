<?php

class PhotoAlbum extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
            'name' => 'required|between:3,250',
            'cover' => 'image'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'cover', 'user_id'];
        
        public function getCoverAttribute($value){
            return asset(($value)?$value:'img/56.png');
        }
        
        public function photos(){
            return $this->hasMany('Photo', 'album_id');
        }
}