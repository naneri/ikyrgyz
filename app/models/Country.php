<?php

class Country extends \Eloquent {
	protected $fillable = [];
        protected $connection = 'mysql_users';
        
        public static function getAllForView(){
            $countries = array('0' => 'Страна');
            foreach (Country::all() as $country) {
                $countries[$country->id] = $country->name_ru;
            }
            return $countries;
        }
        
        public function cities(){
            return $this->hasMany('City');
        }
}