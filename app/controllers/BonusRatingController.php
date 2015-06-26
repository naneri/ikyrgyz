<?php

class BonusRatingController extends \BaseController {
    public function index()
    {}

    private function createBonusRating($targetType, $targetId, $value, $rating){
        $bonusRating = new BonusRating();
        $bonusRating->target_id = $targetId;
        $bonusRating->target_type = $targetType;
        $bonusRating->user_id = Auth::user()->id;
        $bonusRating->value = $value;
        $bonusRating->rating = $rating;
        $bonusRating->save();
    }

    public function postBonusRatingComment(){

        $oComment = TopicComment::find(Input::get('comment_id'));
        $iValue = Input::get('value');

        if(!$oComment){
            return Response::json(array('error' => 'Комментарий не найден'));
        }

        if(!in_array($iValue, array('1', '-1')) ){
            return Response::json(array('error' => 'Ошибка в значении'));
        }

        if($oComment->user_id == Auth::user()->id){
            return Response::json(array('error' => 'Вы не можете проголосовать за свой комментарий'));
        }

        $anyBonusRatingExists = BonusRating::where('target_type', 'comment')
            ->where('user_id', Auth::user()->id)
            ->exists();

        if (!$anyBonusRatingExists) {

        } else {
            $bonusRatingExists = BonusRating::where('target_type', 'comment')
                ->where('user_id', Auth::user()->id)
                ->where('target_id', $oComment->id)
                ->exists();
            if($bonusRatingExists){
                return Response::json(array('error' => 'Вы уже голосовали за этот комментарий'));
            }

            $oComment->bonusRating($iValue);
            $oComment->save();

            $this->createBonusRating('comment', $oComment->id, $iValue, $oComment->rating);
            $this->setSkillCommentAuthor($oComment->user_id, $iValue);

        }


        return Response::json(array('success' => 'Ваш голос учтен', 'rating' => round($oComment->rating,2)));
    }

    public function postBonusRatingTopic(){
        $oTopic = Topic::find(Input::get('topic_id'));
        $iValue = Input::get('value');

        if (!$oTopic) {
            return Response::json(array('error' => 'Топик не найден'));
        }

        if (!in_array($iValue, array('1', '-1'))) {
            return Response::json(array('error' => 'Ошибка значения'));
        }

        if ($oTopic->user_id == Auth::user()->id) {
            return Response::json(array('error' => 'Вы не может проголосовать за свой топик'));
        }

        $bonusRatingExists = BonusRating::where('target_type', 'topic')
            ->where('user_id', Auth::user()->id)
            ->where('target_id', $oTopic->id)
            ->exists();
        if ($bonusRatingExists) {
            return Response::json(array('error' => 'Вы уже голосовали за этот топик'));
        }

        $oTopic->bonusRating($iValue);
        $oTopic->save();

        $this->createBonusRating('topic', $oTopic->id, $iValue, $oTopic->rating);
        $this->setSkillTopicAuthor($oTopic->user_id, $iValue);

        return Response::json(array('success' => 'Ваш голос учтен', 'rating' => round($oTopic->rating,2)));
    }

    public function postBonusRatingBlog(){
        $oBlog = Blog::find(Input::get('blog_id'));
        $iValue = Input::get('value');

        if (!$oBlog) {
            return Response::json(array('error' => 'Блог не найден'));
        }

        if (!in_array($iValue, array('1', '-1'))) {
            return Response::json(array('error' => 'Ошибка значения'));
        }

        if ($oBlog->user_id == Auth::user()->id) {
            return Response::json(array('error' => 'Вы не может проголосовать за свой блог'));
        }

        $bonusRatingExists = BonusRating::where('target_type', 'blog')
            ->where('user_id', Auth::user()->id)
            ->where('target_id', $oBlog->id)
            ->exists();
        if ($bonusRatingExists) {
            return Response::json(array('error' => 'Вы уже голосовали за этот блог'));
        }

        $oBlog->bonusRating($iValue);
        $oBlog->save();

        $this->createBonusRating('blog', $oBlog->id, $iValue, $oBlog->rating);

        return Response::json(array('success' => 'Ваш голос учтен', 'rating' => round($oBlog->rating,2)));
    }

    public function postBonusRatingUser(){
        $oUser = User::find(Input::get('user_id'));
        $iValue = Input::get('value');

        if (!$oUser) {
            return Response::json(array('error' => 'Пользователь не найден'));
        }
        if (!in_array($iValue, array('1', '-1'))) {
            return Response::json(array('error' => 'Ошибка значения'));
        }

        if ($oUser->id == Auth::user()->id) {
            return Response::json(array('error' => 'Вы не может проголосовать за свой профиль'));
        }

        $bonusRatingExists = BonusRating::where('target_type', 'user')
            ->where('user_id', Auth::user()->id)
            ->where('target_id', $oUser->id)
            ->exists();

        if ($bonusRatingExists) {
            return Response::json(array('error' => 'Вы уже голосовали за этого пользователя'));
        }

        $oUser->bonusRating($iValue);
        $oUser->save();

        $this->createBonusRating('user', $oUser->id, $iValue, $oUser->rating);
        $this->setSkillUser($oUser->id, $iValue);

        return Response::json(array('success' => 'Ваш голос учтен', 'rating' => round($oUser->rating,2)));
    }

    public function postBonusRatingPhoto(){
        $oPhoto = Photo::find(Input::get('photo_id'));
        $iValue = Input::get('value');

        if (!$oPhoto) {
            return Response::json(array('error' => 'Фотография не найдена'));
        }
        if (!in_array($iValue, array('1', '-1'))) {
            return Response::json(array('error' => 'Ошибка значения'));
        }

        if ($oPhoto->user_id == Auth::id()) {
            return Response::json(array('error' => 'Вы не может проголосовать за свою фотографию'));
        }

        $bonusRatingExists = BonusRating::where('target_type', 'photo')
            ->where('user_id', Auth::id())
            ->where('target_id', $oPhoto->id)
            ->exists();

        if ($bonusRatingExists) {
            return Response::json(array('error' => 'Вы уже голосовали за эту фотографию'));
        }

        $oPhoto->bonusRating($iValue);
        $oPhoto->save();

        $this->createBonusRating('photo', $oPhoto->id, $iValue, $oPhoto->rating);

        // начисляем силу автору как в комментариях
        $this->setSkillCommentAuthor($oPhoto->user_id, $iValue);

        return Response::json(array('success' => 'Ваш голос учтен', 'rating' => round($oPhoto->rating, 2)));
    }

    private function setSkillCommentAuthor($commentAuthorId, $bonusRatingValue) {
        /**
         * Начисляем силу автору, используя логарифмическое распределение
         */
        $skill = Auth::user()->skill;
        $iMinSize = 0.004;
        $iMaxSize = 0.5;
        $iSizeRange = $iMaxSize - $iMinSize;
        $iMinCount = log(0 + 1);
        $iMaxCount = log(500 + 1);
        $iCountRange = $iMaxCount - $iMinCount;
        if ($iCountRange == 0) {
            $iCountRange = 1;
        }
        if ($skill > 50 and $skill < 200) {
            $skill_new = $skill / 70;
        } elseif ($skill >= 200) {
            $skill_new = $skill / 10;
        } else {
            $skill_new = $skill / 130;
        }
        $iDelta = $iMinSize + (log($skill_new + 1) - $iMinCount) * ($iSizeRange / $iCountRange);
        /**
         * Сохраняем силу
         */
        $oUserComment = User::find($commentAuthorId);
        if($oUserComment){
            $iSkillNew = $oUserComment->skill + $bonusRatingValue * $iDelta;
            $iSkillNew = ($iSkillNew < 0) ? 0 : $iSkillNew;
            $oUserComment->skill = $iSkillNew;
            $oUserComment->save();
        }
    }

    public function setSkillTopicAuthor($topicAuthorId, $iValue) {
        $skill = Auth::user()->skill;
        /**
         * Начисляем силу и рейтинг автору топика, используя логарифмическое распределение
         */
        $iMinSize = 0.1;
        $iMaxSize = 8;
        $iSizeRange = $iMaxSize - $iMinSize;
        $iMinCount = log(0 + 1);
        $iMaxCount = log(500 + 1);
        $iCountRange = $iMaxCount - $iMinCount;
        if ($iCountRange == 0) {
            $iCountRange = 1;
        }
        if ($skill > 50 and $skill < 200) {
            $skill_new = $skill / 70;
        } elseif ($skill >= 200) {
            $skill_new = $skill / 10;
        } else {
            $skill_new = $skill / 100;
        }
        $iDelta = $iMinSize + (log($skill_new + 1) - $iMinCount) * ($iSizeRange / $iCountRange);
        /**
         * Сохраняем силу и рейтинг
         */
        $oUserTopic = User::find($topicAuthorId);
        if($oUserTopic){
            $iSkillNew = $oUserTopic->skill + $iValue * $iDelta;
            $iSkillNew = ($iSkillNew < 0) ? 0 : $iSkillNew;
            $oUserTopic->skill = $iSkillNew;
            $oUserTopic->rating = $oUserTopic->rating + $iValue * $iDelta / 2.73;
            $oUserTopic->save();
        }
    }
}