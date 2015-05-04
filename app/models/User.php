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
        
    protected $guarded = array('id');    
    
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


                                        /* RELATIONS */

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
    
                                    /* RELATIONS */


    public function getBannedUserIds(){
        return User::join('friends', 'friends.user_two', '=', 'users.id')
                ->where('friends.status', Config::get('social.friend_status.banned'))
                ->where('friends.user_one', Auth::id())
                ->lists('friends.user_two');
    }
    
    public function messagesInbox(){
        $bannedIds = $this->getBannedUserIds();
        return $this->hasMany('Message', 'receiver_id', 'id')->where('draft', '0')->whereNotIn('sender_id', $bannedIds);
    }

    public function messagesOutbox() {
        return $this->hasMany('Message', 'sender_id', 'id')->where('draft', '0');
    }

    public function messagesTrashed() {
        return 
        Message::where(function($query){
            $query->where('sender_id', $this->id)
                    ->orWhere('receiver_id', $this->id);
        })->onlyTrashed()->get();
    }
    
    public function messagesDraft(){
        return $this->hasMany('Message', 'sender_id', 'id')->where('draft', '1');
    }
    
    public function bannedUsers() {
        return User::join('friends', 'friends.user_two', '=', 'users.id')
                        ->where('friends.status', Config::get('social.friend_status.banned'))
                        ->where('friends.user_one', Auth::id())
                        ->select('users.*')
                        ->get();
    }

    public function messagesOf($userId) {
        return $this->hasMany('Message', 'receiver_id', 'id')->where('sender_id', $userId);
    }

    public function friends(){
        return User::join('friends', 'friends.user_one', '=', 'users.id')
                ->join('user_description', 'user_description.user_id', '=', 'users.id')
                ->where('friends.status', Config::get('social.friend_status.friends'))
                ->where('friends.user_two', $this->id)
                ->select('users.*', 'user_description.*')
                ->get();
    }

    public function mutualFriends() {
        return User::join('friends', 'friends.user_one', '=', 'users.id')
                        ->join('user_description', 'user_description.user_id', '=', 'users.id')
                        ->where('friends.status', Config::get('social.friend_status.friends'))
                        ->where('friends.user_two', $this->id)
                        ->whereIn('friends.user_one', Auth::user()->friends()->lists('id'))
                        ->select('users.*', 'user_description.*')
                        ->get();
    }

    public function newsline($topicsLimit, $page=0){
        $votedTopicIds = $this->votes()->where('target_type', 'topic')->where('value', '1')->lists('target_id');
        $subscribedTopicIds = Topic::join('blogs', 'blogs.id', '=', 'topics.blog_id')
                ->whereIn('blogs.id', $this->canPublishBlogs()->lists('id'))
                ->select('topics.id')
                ->lists('id');
        $topicIds = array_merge($votedTopicIds, $subscribedTopicIds);
        $uniqueTopicIds = array_unique($topicIds);
        return Topic::with('blog', 'user', 'comments', 'user.description', 'blog.topics')
                ->join('blogs', 'blogs.id', '=', 'topics.blog_id')
                ->join('blog_types', 'blog_types.id', '=', 'blogs.type_id')
                ->where(function($query){
                    $query->whereIn('blog_types.name', array('personal', 'open'))
                        ->orWhereIn('blogs.id', Auth::user()->canPublishBlogs()->lists('id'));
                })
                ->whereIn('topics.id', $uniqueTopicIds)
                ->orderBy('topics.created_at', 'desc')
                ->take($topicsLimit)
                ->offset($page*$topicsLimit)
                ->select('topics.*')
                ->get();
    }
    
    public function publications($topicsLimit, $page=0){
        return $this->topics()
                ->with('blog', 'blog.topics', 'user', 'comments', 'user.description')
                ->join('blogs', 'blogs.id', '=', 'topics.blog_id')
                ->join('blog_types', 'blog_types.id', '=', 'blogs.type_id')
                ->where(function($query){
                    $query->whereIn('blog_types.name', array('personal', 'open'))
                        ->orWhereIn('blogs.id', Auth::user()->canPublishBlogs()->lists('id'));
                })
                ->orderBy('topics.created_at', 'desc')
                ->take($topicsLimit)
                ->offset($topicsLimit*$page)
                ->select('topics.*')
                ->get();
    }
    
    public function votes(){
        return $this->hasMany('Vote');
    }
    
    public function getNames(){
        return $this->description->first_name.' '.$this->description->last_name;
    }
    
    public function avatar(){
        return asset((@$this->description->user_profile_avatar)?@$this->description->user_profile_avatar:'img/48.png');
    }
    
    public function canSendMessage($userId){
        return Friend::getFriendStatus(Auth::id(), $userId) == Config::get('social.friend_status.friends');
    }

    public function setDescriptionArrayAttribute($values){
        $this->description->update($values);
    }

    public function topics(){
        return $this->hasMany('Topic')->where('draft', '0');
    }

    public function topicsWithDraft() {
        return $this->hasMany('Topic');
    }
    
    public function topicsWithVideo(){
        return $this->topics()
                ->with('blog', 'blog.topics', 'user', 'comments', 'user.description')
                ->join('blogs', 'blogs.id', '=', 'topics.blog_id')
                ->join('blog_types', 'blog_types.id', '=', 'blogs.type_id')
                ->where(function($query) {
                    $query->whereIn('blog_types.name', array('personal', 'open'))
                    ->orWhereIn('blogs.id', Auth::user()->canPublishBlogs()->lists('id'));
                })
                ->where('topics.description', 'like', '%youtube%')
                ->orderBy('topics.created_at', 'desc')
                ->select('topics.*');
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
    
    public function subscribtions($offset = 0){
        $blogLimit = Config::get('topic.topics_per_page');
        $blogs = Blog::join('blog_roles', 'blog_roles.blog_id', '=', 'blogs.id')
                ->join('roles', 'blog_roles.role_id', '=', 'roles.id')
                ->whereIn('roles.name', array('admin', 'moderator', 'reader'))
                ->where('blog_roles.user_id', $this->id)
                ->select('blogs.*')
                ->skip($offset*$blogLimit)
                ->take($blogLimit)
                ->get();
        return $blogs;
    }
    
    public function subscribers(){
        $subscribers = Blog::join('blog_roles', 'blog_roles.blog_id', '=', 'blogs.id')
                ->join(Config::get('database.connections.mysql_users.database') . '.users', 'users.id', '=', 'blog_roles.user_id')
                ->join(Config::get('database.connections.mysql_users.database') . '.user_description', 'users.id', '=', 'user_description.user_id')
                ->join('roles', 'blog_roles.role_id', '=', 'roles.id')
                ->whereIn('roles.name', array('admin', 'moderator', 'reader'))
                ->where('blog_roles.user_id', '!=', $this->id)
                ->where('blogs.user_id', $this->id)
                ->distinct()
                ->select('users.*', 'user_description.*')
                ->get();
        return $subscribers;
    }
    
    public function isHavePersonalBlog(){
        return Blog::join('blog_types', 'blog_types.id','=','blogs.type_id')
                ->where('blog_types.name', 'personal')
                ->where('blogs.user_id', $this->id)
                ->exists();
    }

    public function createPersonalBlog() {
        if (!$this->isHavePersonalBlog()) {
            $blog = Blog::create(array(
                'user_id' => $this->id,
                'type_id' => Config::get('blog.blogType.personal'),
                'title' => 'Блог пользователя' . $this->id,
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
    
    public function getSubscribedClosedBlogs(){
        return Blog::join('blog_types', 'blog_types.id', '=', 'blogs.type_id')
                ->join('blog_roles', 'blog_roles.blog_id', '=', 'blogs.id')
                ->join('roles', 'blog_roles.role_id', '=', 'roles.id')
                ->where('blog_types.name', 'close')
                ->where('blogs.user_id', $this->id)
                ->orWhere(function($query){
                    $query->whereIn('roles.name', array('admin', 'moderator', 'reader'))
                        ->where('blog_roles.user_id', $this->id);
                })
                ->select('blogs.*')
                ->get();
    }
    
    public function profileItems(){
        return $this->hasMany('ProfileItem');
    }
    
    public function profileItemsGetValues($subtype) {
        $canSee = Auth::id() == $this->id;
        $isFriends = Friend::checkIfFriend($this->id, Auth::id());
        $items = $this->profileItems()->where('subtype', $subtype)->get();//->lists('value');
        $values = array();
        foreach($items as $item){
            if(($canSee || $item->access == 'all') || ($item->access == 'friend' && $isFriends)){
                $values[] = $item->value;  
            }
        }
        return $values;
    }

    public function getRandomUser($friendIds){
        return User::whereHas('description', function($query){
                                $query->where('user_profile_avatar', '!=', 'NULL');
                            })
                            ->whereNotIn('id', $friendIds)
                            ->orderByRaw("RAND()")
                            ->first()
                            ->id;
    }
    
    public function getRatingAttribute($rating){
        return round($rating, 2);
    }
    
    public function age(){
        return date_diff(date_create($this->description->birthday), date_create('today'))->y;
    }

    public static function newUser($email, $password){

        // генерируем код для активации пользователя
        $code = str_random(60);

        // хэшируем пароль
        $hashed_pass  = Hash::make($password);

        // создаём юзера
        return self::create([
            'email'             => $email,
            'password'          => $hashed_pass,
            'activation_code'   => $code
            ]);
    }
}
