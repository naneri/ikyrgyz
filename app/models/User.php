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
            'password' => 'required|alpha_num|between:6,50',
            'recaptcha_response_field' => 'required|recaptcha',
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
            $iNewRating = round($iValue * $iDelta, 3);
            $this->rating += $iNewRating;
            return $iNewRating;
        }
        
        public function canPublishBlogs(){
            $blogs = Blog::join('blog_types', 'blog_types.id', '=', 'blogs.type_id')
                    ->leftjoin('blog_roles', 'blog_roles.blog_id', '=', 'blogs.id')
                    ->leftjoin('roles', 'blog_roles.role_id', '=', 'roles.id')
                    ->where('blog_types.name', '!=', 'personal')
                    ->where(function($query){
                        $query->where('blogs.user_id', $this->id)
                            ->orWhere(function($query){
                                $query->whereIn('roles.name', array('admin', 'moderator', 'reader'))
                                    ->where('blog_roles.user_id', $this->id);
                        });
                    })
                    ->select('blogs.*')
                    ->get();
            return $blogs;
        }
        
        public function isHavePersonalBlog(){
            return Blog::join('blog_types', 'blog_types.id','=','blogs.type_id')
                    ->where('blog_types.name', 'personal')
                    ->where('blogs.user_id', $this->id)
                    ->exists();
        }

        public function createPersonalBlog() {
            if (!$this->isHavePersonalBlog()) {
                Blog::create(array(
                    'user_id' => $this->id,
                    'type_id' => Config::get('blog.blogType.personal'),
                    'title' => 'Блог им. ' . $this->email,
                    'description' => 'Это ваш персональный блог.'
                ));
            }
        }
        
        public function getPersonalBlog(){
            return Blog::join('blog_types', 'blog_types.id', '=', 'blogs.type_id')
                ->where('blog_types.name', 'personal')
                ->where('blogs.user_id', $this->id)
                ->select('blogs.*')
                ->first();
        }
        
        public function profileItems(){
            return $this->hasMany('ProfileItem');
        }
        
        public function schools(){
            return $this->hasMany('ProfileItem')->where('type', 'study')->where('subtype', 'school');
        }
        
        public function universities() {
            return $this->hasMany('ProfileItem')->where('type', 'study')->where('subtype', 'university');
        }

        public function jobs() {
            return $this->hasMany('ProfileItem')->where('type', 'experience')->where('subtype', 'job');
        }
        
        public function contacts(){
            return $this->hasMany('ProfileItem')->where('type', 'contact');
        }
        
        public function familyMembers(){
            return $this->hasMany('ProfileItem')->where('type', 'family');
        }
        
        public function additionals(){
            return $this->hasMany('ProfileItem')->where('type', 'additional');
        }

}
