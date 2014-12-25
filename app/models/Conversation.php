<?php

class Conversations extends Eloquent {
	protected $fillable = [];

	public function messages(){
		$this->hasMany('Message', 'conversation_id', 'id');
	}
}