<?php

class City extends \Eloquent {
	protected $fillable = [];
        protected $connection = 'mysql_users';

        public static function getAllForView(){
            $cities = array('0' => 'Город');
            foreach (City::all() as $city) {
                $cities[$city->id] = $city->name;
            }
            return $cities;
        }
}