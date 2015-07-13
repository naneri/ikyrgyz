<?php

class PhotoComment extends \Eloquent {

    // Don't forget to fill this array
    protected $fillable = ['text', 'user_id', 'parent_id', 'photo_id'];
    
    protected $connection = 'mysql_users';
    
    public static $rules   = array(
                                'photo_id' => 'required|integer',
                                'text' => 'required'
                            );

    public function childComments() {
        return $this->hasMany('PhotoComment', 'parent_id');
    }

    public function childCommentsWithUserData() {
        return $this->childComments()
                        ->join('user_description', 'user_description.user_id', '=', 'photo_comments.user_id')
                        ->join('users', 'users.id', '=', 'photo_comments.user_id');
    }

    public function childCommentsSortBy($sort) {
        $comments = array();
        switch ($sort) {
            case 'new':
                $comments = $this->childCommentsWithUserData()->orderBy('created_at', 'DESC');
                break;
            case 'rating':
                $comments = $this->childCommentsWithUserData()->orderBy('rating', 'DESC');
                break;
            case 'old':
            default:
                $comments = $this->childCommentsWithUserData()->orderBy('created_at', 'ASC');
                break;
        }
        return $comments->select('photo_comments.*', 'user_description.*', 'users.rating as author_rating')->get();
    }

    public function withUserData() {
        return $this->join('user_description', 'user_description.user_id', '=', 'photo_comments.user_id')
                        ->join('users', 'users.id', '=', 'photo_comments.user_id')
                        ->where('photo_comments.id', $this->id)
                        ->select('photo_comments.*', 'user_description.*', 'users.rating as author_rating')
                        ->first();
    }

    public function parentWithUserData() {
        return $this->parent()->join('user_description', 'user_description.user_id', '=', 'photo_comments.user_id')->first();
    }

    public function user() {
        return $this->belongsTo('User');
    }

    public function parent() {
    return $this->belongsTo('PhotoComment', 'parent_id', 'id');


        }

public function userDescription() {
    return $this->belongsTo('User_Description', 'user_id', 'user_id');
}

public function canDelete() {
    return
            Auth::user()->id == $this->user->id ||
            $this->topic->blog->isModeratorCurrentUser();
}

public function isAuthor() {
    return Auth::user()->id == $this->user->id;
}

public function canView() {
    return
            !$this->trash ||
            Auth::user()->id == $this->user->id ||
            $this->topic->blog->isModeratorCurrentUser();
}

public function canRestore() {
    return $this->canDelete();
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

public function getRatingAttribute($rating) {
    return round($rating, 2);
}

}
