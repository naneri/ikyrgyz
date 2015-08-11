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
}