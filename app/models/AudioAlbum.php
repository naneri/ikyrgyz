<?php

class AudioAlbum extends \Eloquent {

    // Add your validation rules here
    public static $rules = [
        'name' => 'required|between:3,250',
        'cover' => 'image|mimes:png,gif,jpeg,jpg'
    ];

    // Don't forget to fill this array
	protected $fillable = ['name', 'cover', 'user_id', 'description', 'access'];

    public function getCoverAttribute($value){
        return asset(($value)?$value:'img/56.png');
    }

    public function audios(){
        return $this->hasMany('Audio', 'album_id');
    }

    public function user(){
        return $this->belongsTo('User');
    }

    public function canEdit(){
        return Auth::id() == $this->user_id;
    }

    public function canView(){
        $access = false;
        if(
            $this->user_id == Auth::id() ||
            $this->access == 'all' ||
            ($this->access == 'friend' && Friend::checkIfFriend($this->user_id, Auth::id()))
        ){
            $access = true;
        }
        return $access;
    }

    public function getRatingAttribute($value){
        return round($value, 2);
    }

    public function vote($iValue) {
        $this->rating += $iValue;
        if ($iValue == 1) {
            $this->increment('vote_up');
        } elseif ($iValue == -1) {
            $this->increment('vote_down');
        }
        return $iValue;
    }
}