<?php

class Topic extends Eloquent {
    
	protected $fillable = [];
        
    public static $rules = array(
        'title' => 'required|min:3',
        'blog_id' => 'required',
    );

    protected static $orderType = [
            'id'    => 'id',
            'top'   => 'rating',
            'index' => 'id'
        ];

    public function tags() {
        return $this->belongsToMany('Tag');
    }

    public function type(){
        return $this->belongsTo('TopicType', 'type_id');
    }
    
    public function video() {
        return $this->hasOne('TopicVideo');
    }
    
    public function user(){
        return $this->belongsTo('User');
    }

    public function userDescription() {
        return $this->belongsTo('User_Description', 'user_id', 'user_id');
    }

    public function author() {
        return $this->belongsTo('User', 'user_id');
    }
    
    public function comments(){
        return $this->hasMany('TopicComment');
    }

    public function commentsChild($parentId = 0){
        return $this->hasMany('TopicComment')->where('parent_id', $parentId);
    }

    public function created_at(){
        return Date::parse($this->created_at)->format('j F Y');
    }

    public function blog(){
        return $this->belongsTo('Blog');
    }
    
    public function photoAlbums(){
        return $this->belongsToMany('PhotoAlbum');
    }
    
    public function photos(){
        return $this->belongsToMany('Photo');
    }
    
    public function audioAlbums(){
        return $this->belongsToMany('AudioAlbum');
    }
    
    public function audio(){
        return $this->belongsToMany('Audio');
    }    

    static function getMainTopics($rating = null, $sort = 'id', $offset = 0) {
        $orderBy = 'topics.' . self::$orderType[$sort];
		return 	Topic::mainTopicQuery($offset)
                    ->orderBy($orderBy, 'DESC')
                    ->select('topics.*')
                    ->get();/*where('topics.rating', '>', $rating)
                  ->join('blogs', 'topics.blog_id', '=', 'blogs.id')
                  ->join('blog_subscriptions as us', function ($j) use ($userId){
                  $j->on('us.blog_id', '=', 'blogs.id')
                  ->where('us.user_id', '=', $userId);
                  })
                  ->take($topic_number)
                  ->offset($offset)
    				->get(['topics.*']);*/
    }
    

    static function getTopicsByRating($offset = 0){

        $topics = Topic::mainTopicQuery($offset)
                ->orderBy('topics.rating', 'DESC')
                ->select('topics.*')
                ->get();
        return $topics;
    }


    /**
     * Вспомогательная функция - строит первую часть запроса для других функций.
     * Основное предназначение - указание данных которые необходимо выбрать.
     * 
     * @return [type] [description]
     */
    static function mainTopicQuery($offset){

        $topicLimit = Config::get('topic.topics_per_page');

        return Topic::with('blog', 'user', 'user.description', 'comments', 'blog.topics')
                ->join('blogs', 'blogs.id', '=', 'topics.blog_id')
                ->join('blog_types', 'blog_types.id', '=', 'blogs.type_id')
                ->where('topics.draft', '=', '0')
                ->whereIn('blog_types.name', array('personal', 'open'))
                ->orWhereIn('blogs.id', Auth::user()->canPublishBlogs()->lists('id'))
                ->skip( $offset * $topicLimit ) 
                ->take($topicLimit);
    }
    
    public function tagsToString(){
        $stringTags = '';
        foreach($this->tags as $tag){
            $stringTags .= $tag->name.', ';
        }
        $stringTags = rtrim(trim($stringTags), ',');
        return $stringTags;
    }
    
    
    
    public function commentsWithData(){
        return $this->comments()
                ->join(Config::get('database.connections.mysql_users.database').'.user_description','user_description.user_id','=','topic_comments.user_id')
                ->join(Config::get('database.connections.mysql_users.database') . '.users', 'users.id', '=', 'topic_comments.user_id');
    }

    public function commentsWithDataSortBy($sort) {
        $comments = array();
        switch($sort){
            case 'new':
                $comments = $this->commentsWithData()->orderBy('created_at', 'DESC');
                break;
            case 'rating':
                $comments = $this->commentsWithData()->orderBy('rating', 'DESC');
                break;
            case 'old':
            default:
                $comments = $this->commentsWithData()->orderBy('created_at', 'ASC');
                break;
        }
        $commentsSelected = $comments->select('topic_comments.*', 'user_description.*', 'users.rating as author_rating')->get();
        $bonusRating = new BonusRating();
        foreach ($commentsSelected as &$v) {
            $v->author_rating += $bonusRating->getUsersBonusRating($v->user_id);
        }
        return $commentsSelected;
    }

    public function canEdit(){
        return $this->blog->isAdminCurrentUser() || $this->user_id == Auth::id() || Auth::user()->is_admin;
    }
    
    public function vote($iValue){
        /**
         * Устанавливаем рейтинг топика
         */
        $skill = Auth::user()->skill;
        $iDeltaRating = $iValue;
        if ($skill >= 100 and $skill < 250) {
            $iDeltaRating = $iValue * 2;
        } elseif ($skill >= 250 and $skill < 400) {
            $iDeltaRating = $iValue * 3;
        } elseif ($skill >= 400) {
            $iDeltaRating = $iValue * 4;
        }
        $iDeltaRating = round($iDeltaRating, 3);
        $this->rating += $iDeltaRating;

        if ($iValue == 1) {
            $this->increment('vote_up');
        } elseif ($iValue == -1) {
            $this->increment('vote_down');
        }
        
        return $iDeltaRating;
    }

    public function delete(){
        $this->video()->delete();
        $this->comments()->delete();
        return parent::delete();
    }

    public function getRatingAttribute($rating) {
        return round($rating, 2);
    }
    
    public function isFavourite(){
        return Favourite::where('user_id', Auth::id())
                ->where('target_type', 'topic')
                ->where('target_id', $this->id)
                ->exists();
    }
    
    public function favourites(){
        return $this->morphMany('Favourite', 'target');
    }

    static function favoriteTopics($user_id, $offset = 0){

        $topicLimit = Config::get('topic.topics_per_page');

        return Topic::join('favourites', 'topics.id', '=', 'favourites.target_id')
                        ->where('favourites.user_id', $user_id)
                        ->where('target_type', 'topic')
                        ->skip( $offset * $topicLimit ) 
                        ->take($topicLimit)
                        ->get();
    }

    static function videoTopics($user_id, $offset = 0){

        $topicLimit = Config::get('topic.topics_per_page');

        return Topic::where('description', 'like', '%x-shockwave-flash%')
                        ->skip( $offset * $topicLimit ) 
                        ->take($topicLimit)
                        ->get();
    }

    static function userTopics($user_id, $offset = 0){

        $topicLimit = Config::get('topic.topics_per_page');

        return Topic::where('user_id', $user_id)
                        ->skip( $offset * $topicLimit ) 
                        ->take($topicLimit)
                        ->get();
    }

    static function linkTopics($offset = 0){

        $topicLimit = Config::get('topic.topics_per_page');

        return Topic::join('topic_types', 'topics.type_id', '=', 'topic_types.id')
                        ->where('topic_types.id', 4)
                        ->skip( $offset * $topicLimit ) 
                        ->take($topicLimit)
                        ->get();
    }


}