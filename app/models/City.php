<?php

class City extends \Eloquent {
	protected $fillable = [];
        protected $connection = 'mysql_users';

        public static function getAllForView(){
            $cities = array('0' => 'Город');
            foreach (City::all() as $city) {
                $cities[$city->id] = $city->name_ru;
            }
            return $cities;
        }
        
        public static function getCitiesByCountryId($countryId){
            $cities = City::where('country_id', $countryId)->get();
            $citiesForView = array('0' => 'Город');
            foreach ($cities as $city) {
                $citiesForView[$city->id] = $city->name_ru;
            }
            return $citiesForView;
        }
}