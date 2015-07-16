<?php

class Audio extends \Eloquent {

    // Add your validation rules here
    public static $rules = [
        'audio_file' => 'required|mimes:mpga',
        'name' => 'string'
    ];

    // Don't forget to fill this array
    protected $fillable = ['name', 'url', 'user_id', 'album_id'];

    public function album(){
        return $this->belongsTo('AudioAlbum', 'album_id');
    }

    public function canEdit() {
        return Auth::id() == $this->user_id;
    }

    public function canView(){
        return $this->album->canView();
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