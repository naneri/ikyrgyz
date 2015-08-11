<?php 

class VoteRepository {

    public static function create($targetType, $targetId, $value, $rating, $user_id){

        Vote::create([
            'target_id'     => $targetId,
            'target_type'   => $targetType,
            'user_id'       => $user_id,
            'value'         => $value,
            'rating'        => $rating,
            ]);
    }
}