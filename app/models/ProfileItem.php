<?php

class ProfileItem extends \Eloquent {
	protected $fillable = [];
        protected $connection = "mysql_users";
        
        public function users(){
            return $this->belongsTo('User');
        }
        
        public function phones(){
            
        }
}