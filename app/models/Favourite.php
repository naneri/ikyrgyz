<?php

class Favourite extends \Eloquent {

	protected $fillable = ['user_id', 'target_id', 'target_type'];
        
    public function target(){
        return $this->morphTo();
    }
}