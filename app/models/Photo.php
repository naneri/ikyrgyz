<?php

class Photo extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
            'image' => 'required|image',
            'name' => 'string'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'url', 'user_id', 'album_id'];

}