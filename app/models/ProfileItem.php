<?php

class ProfileItem extends \Eloquent {
	protected $fillable = [];
        protected $connection = "mysql_users";
        
        public function users(){
            return $this->belongsTo('User');
        }
        
        public function phones(){
            
        }
        
        public static function getForView($subtype){
            $profileItems = array();//'' => 'Выбрать');
            foreach(ProfileItem::where('subtype', $subtype)->select('value')->distinct()->lists('value') as $item){
                $profileItems[$item] = $item;
            }
            return $profileItems;
        }

        public static function getForViewMy($subtype) {
            $profileItems = array(); //'' => 'Выбрать');
            foreach (ProfileItem::where('user_id', Auth::id())->where('subtype', $subtype)->select('value')->distinct()->lists('value') as $item) {
                $profileItems[$item] = $item;
            }
            return $profileItems;
        }

}