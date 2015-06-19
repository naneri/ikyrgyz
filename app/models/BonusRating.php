<?php

class BonusRating extends \Eloquent {
	protected $fillable = ["target_id", "target_type", "user_id", "value"];

    public static function addBonusRating($targetType, $targetId, $value){
        self::create([
            "target_id" => $targetId,
            "target_type" => $targetType,
            "user_id" => Auth::user()->id,
            "value" => $value
        ]);
    }

    public function getUsersBonusRating($user_id)
    {
        $totalBonusRating = 0;

        $bonusRatingVal = DB::select('select SUM(`value`) AS total
        from `bonus_ratings`
        where (`target_type`="upload_avatar"
        or `target_type`="like_dislike_topic"
        or `target_type`="comment"
        or `target_type`="upload_photo"
        or `target_type`="click_random"
        or `target_type`="topic_create"
        or `target_type`="blog_create"
        or `target_type`="have_1000_friend"
        or `target_type`="everyday_visit")
        and `user_id`=\''.$user_id.'\'
        group by (`user_id`)');

        $someoneLikedTopicBonusRatingVal = DB::select('
            select SUM(`br`.`value`) AS total
                from `bonus_ratings` br
                left join `topics` t on `t`.`id`=`br`.`target_id`
                where `target_type`="someones_topic_liked_disliked"
                and `t`.`user_id`=\''.$user_id.'\''
        );

        if (!empty($someoneLikedTopicBonusRatingVal)) {
            $totalBonusRating += $someoneLikedTopicBonusRatingVal[0]->total;
        }

        if (!empty($bonusRatingVal)) {
            $totalBonusRating = intval($bonusRatingVal[0]->total);
        }

        return $totalBonusRating;
    }
}