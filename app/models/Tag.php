<?php

class Tag extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
                'name' => 'required|min:2|max:200|unique:tags,name'
        ];

	// Don't forget to fill this array
	protected $fillable = [];

	public function topics() {
            return $this->belongsToMany('Topic');
        }

}