<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent implements UserInterface, RemindableInterface {


    protected $connection = 'mysql_users';
	
    use UserTrait, RemindableTrait;
    
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
        
        
	// Add your validation rules here
    public static $rules = [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|alpha_num|between:4,50'
    ];

        /**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function blog()
	{
		 return $this->belongsTo('Blog');
	}
        
    public function photoAlbums(){
        return $this->hasMany('PhotoAlbum');
    }
    
    public function photos(){
        return $this->hasMany('Photo');
    }

    public function audioAlbums() {
        return $this->hasMany('AudioAlbum');
    }

    public function audios() {
        return $this->hasMany('Audio');
    }
        
	public function description()
    {
        return $this->hasOne('User_Description', 'user_id', 'id');
    }

    public function setDescriptionArrayAttribute($values){
        $this->description->update($values);
    }

    public function topics(){
        return $this->hasMany('Topic');
    }

    public function drafts(){
        return Topic::join('topic_types', 'topics.type_id', '=', 'topic_types.id')
                ->where('topic_types.name', 'draft')
                ->select('topics.*')
                ->get();
    }

    /**
     * Активируем учётку пользователя
     * 
     * @param  [type] $code [description]
     * @return [type]       [description]
     */
    public static function activate($code){

        // gets the user with activation code
        $user = User::where('activation_code', '=', $code)->first();

        // if no user has been found returns False statement
        if(!$user){
            return False;
        }

        // checks if user has already been activated
        if($user->activated === 1){
            Session::flash('message', 'Your account has already been activated!'); 
            return True;
        }

        //  if no, then activates the user
        $user->activated = 1;
        $user->save();
        Session::flash('message', 'Your account has been activated successfully! You can now log in'); 
        return True;
    }

}
