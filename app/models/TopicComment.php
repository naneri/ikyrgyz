<?php

class TopicComment extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
            'text' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
        
        public function childComments(){
            return $this->hasMany('TopicComment', 'parent_id');
        }
}