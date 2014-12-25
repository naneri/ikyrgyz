<?php

class Photo extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'file' => 'required|image'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}