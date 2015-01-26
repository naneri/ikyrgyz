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
        return Topic::where('draft', 1)
                ->where('user_id', $this->id)
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
    
        public function vote($iValue){
            /**
             * Начисляем силу и рейтинг юзеру, используя логарифмическое распределение
             */
            $skill = Auth::user()->skill;
            $iMinSize = 0.42;
            $iMaxSize = 3.2;
            $iSizeRange = $iMaxSize - $iMinSize;
            $iMinCount = log(0 + 1);
            $iMaxCount = log(500 + 1);
            $iCountRange = $iMaxCount - $iMinCount;
            if ($iCountRange == 0) {
                $iCountRange = 1;
            }
            if ($skill > 50 and $skill < 200) {
                $skill_new = $skill / 40;
            } elseif ($skill >= 200) {
                $skill_new = $skill / 2;
            } else {
                $skill_new = $skill / 70;
            }
            $iDelta = $iMinSize + (log($skill_new + 1) - $iMinCount) * ($iSizeRange / $iCountRange);
            /**
             * Определяем новый рейтинг
             */
            $iNewRating = $iValue * $iDelta;
            $this->rating += $iNewRating;
            return $iNewRating;
        }
        
        public function canPublishBlogs(){
            $blogs = Blog::leftjoin('blog_roles', 'blog_roles.blog_id', '=', 'blogs.id')
                    ->leftjoin('roles', 'blog_roles.role_id', '=', 'roles.id')
                    ->where('blogs.user_id', $this->id)
                    ->orWhereIn('roles.name', array('admin', 'moderator','reader'))
                    ->select('blogs.*')
                    ->get();
            return $blogs;
        }

}
