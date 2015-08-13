<?php 

class BonsuRatingRepository{

    
    public static function addDailyRating($user_id, $rating_value){

        $todayVisitExists = BonusRating::where('target_type', "everyday_visit")
                                ->where('target_id', $user_id)
                                ->where('created_at', '>', date('Y-m-d 00:00:00'))
                                ->exists();

        if (!$todayVisitExists) {
            BonusRating::addBonusRating('everyday_visit', $user_id, $rating_value);
        }
    }  

    public static function blogBonusRating($user_id, $blog_id){
        $anyBlogCreated = BonusRating::where('target_type', "blog_create")
                            ->where('user_id', $user_id)
                            ->exists();
        if ($anyBlogCreated) {
            BonusRating::addBonusRating('blog_create', $blog_id, Config::get('bonus_rating.blog_create'));
        } else {
            BonusRating::addBonusRating('blog_create', $blog_id, Config::get('bonus_rating.first_blog_create'));
        }
    }

    
}