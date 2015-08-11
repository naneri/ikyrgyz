<?php

class VoteController extends \BaseController {
        
	/**
	 * Display a listing of the resource.
	 * GET /vote
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}
        
    private function createVote($targetType, $targetId, $value, $rating){
        VoteRepository::create($targetType, $targetId, $value, $rating, Auth::user()->id);
    }

    public function postVoteComment(){
        
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

        $voteExists = Vote::where('target_type', 'comment')
                ->where('user_id', Auth::user()->id)
                ->where('target_id', $oComment->id)
                ->exists();
        if($voteExists){
            return Response::json(array('error' => 'Вы уже голосовали за этот комментарий'));
        }

        $oComment->vote($iValue);
        $oComment->save();
        
        $this->createVote('comment', $oComment->id, $iValue, $oComment->rating);
        $this->setSkillCommentAuthor($oComment->user_id, $iValue);
        
        return Response::json(array('success' => 'Ваш голос учтен', 'rating' => round($oComment->rating,2)));
    }
    
    public function postVoteTopic(){
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

        $voteExists = Vote::where('target_type', 'topic')
                ->where('user_id', Auth::user()->id)
                ->where('target_id', $oTopic->id)
                ->exists();
        if ($voteExists) {
            return Response::json(array('error' => 'Вы уже голосовали за этот топик'));
        }
        
        $oTopic->vote($iValue);
        $oTopic->save();

        BonusRating::addBonusRating('like_dislike_topic', $oTopic->id, Config::get('bonus_rating.like_dislike_topic'));
        if ($iValue==-1) {
            BonusRating::addBonusRating('someones_topic_liked_disliked', $oTopic->id, Config::get('bonus_rating.someones_topic_disliked'));
        } else {
            BonusRating::addBonusRating('someones_topic_liked_disliked', $oTopic->id, Config::get('bonus_rating.someones_topic_liked'));
        }
        $this->createVote('topic', $oTopic->id, $iValue, $oTopic->rating);
        $this->setSkillTopicAuthor($oTopic->user_id, $iValue);
        
        return Response::json(array('success' => 'Ваш голос учтен', 'rating' => round($oTopic->rating,2)));
    }
    
    public function postVoteBlog(){
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

        $voteExists = Vote::where('target_type', 'blog')
                ->where('user_id', Auth::user()->id)
                ->where('target_id', $oBlog->id)
                ->exists();
        if ($voteExists) {
            return Response::json(array('error' => 'Вы уже голосовали за этот блог'));
        }

        $oBlog->vote($iValue);
        $oBlog->save();

        $this->createVote('blog', $oBlog->id, $iValue, $oBlog->rating);

        return Response::json(array('success' => 'Ваш голос учтен', 'rating' => round($oBlog->rating,2)));
    }
    
    public function postVoteUser(){
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

        $voteExists = Vote::where('target_type', 'user')
                ->where('user_id', Auth::user()->id)
                ->where('target_id', $oUser->id)
                ->exists();

        if ($voteExists) {
            return Response::json(array('error' => 'Вы уже голосовали за этого пользователя'));
        }

        $oUser->vote($iValue);
        $oUser->save();

        $this->createVote('user', $oUser->id, $iValue, $oUser->rating);
        $this->setSkillUser($oUser->id, $iValue);

        return Response::json(array('success' => 'Ваш голос учтен', 'rating' => round($oUser->rating,2)));
    }
    
    public function postVotePhoto(){
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
        
        $voteExists = Vote::where('target_type', 'photo')
                ->where('user_id', Auth::id())
                ->where('target_id', $oPhoto->id)
                ->exists();

        if ($voteExists) {
            return Response::json(array('error' => 'Вы уже голосовали за эту фотографию'));
        }

        $oPhoto->vote($iValue);
        $oPhoto->save();
        
        $oPhoto->album->vote($iValue);

        $this->createVote('photo', $oPhoto->id, $iValue, $oPhoto->rating);
        
        // начисляем силу автору как в комментариях
        $this->setSkillCommentAuthor($oPhoto->user_id, $iValue);

        return Response::json(array('success' => 'Ваш голос учтен', 'rating' => round($oPhoto->rating, 2)));
    }

    public function postVoteAudio() {
        $oAudio = Audio::find(Input::get('audio_id'));
        $iValue = Input::get('value');

        if (!$oAudio) {
            return Response::json(array('error' => 'Музыка не найдена'));
        }
        if (!in_array($iValue, array('1', '-1'))) {
            return Response::json(array('error' => 'Ошибка значения'));
        }

        if ($oAudio->user_id == Auth::id()) {
            return Response::json(array('error' => 'Вы не может проголосовать за свою музыку'));
        }

        $voteExists = Vote::where('target_type', 'audio')
            ->where('user_id', Auth::id())
            ->where('target_id', $oAudio->id)
            ->exists();

        if ($voteExists) {
            return Response::json(array('error' => 'Вы уже голосовали за эту музыку'));
        }

        $oAudio->vote($iValue);
        $oAudio->save();

        $this->createVote('audio', $oAudio->id, $iValue, $oAudio->rating);

        return Response::json(array('success' => 'Ваш голос учтен', 'rating' => round($oAudio->rating, 2)));
    }

    public function postVoteAudioAlbum() {
        $oAudioAlbum = AudioAlbum::find(Input::get('audio_album_id'));
        $iValue = Input::get('value');

        if (!$oAudioAlbum) {
            return Response::json(array('error' => 'Аудио альбом не найден'));
        }
        if (!in_array($iValue, array('1', '-1'))) {
            return Response::json(array('error' => 'Ошибка значения'));
        }

        if ($oAudioAlbum->user_id == Auth::id()) {
            return Response::json(array('error' => 'Вы не может проголосовать за свой аудио альбом'));
        }

        $voteExists = Vote::where('target_type', 'audio_album')
            ->where('user_id', Auth::id())
            ->where('target_id', $oAudioAlbum->id)
            ->exists();

        if ($voteExists) {
            return Response::json(array('error' => 'Вы уже голосовали за этот аудио альбом'));
        }

        $oAudioAlbum->vote($iValue);
        $oAudioAlbum->save();

        $this->createVote('audio_album', $oAudioAlbum->id, $iValue, $oAudioAlbum->rating);

        return Response::json(array('success' => 'Ваш голос учтен', 'rating' => round($oAudioAlbum->rating, 2)));
    }

    private function setSkillCommentAuthor($commentAuthorId, $voteValue) {
        /**
         * Начисляем силу автору, используя логарифмическое распределение
         */
        $iDelta = SkillService::countDeltaComment(Auth::user()->skill);

        /**
         * Сохраняем силу
         */
        $oUserComment = User::find($commentAuthorId);
        if($oUserComment){
            $iSkillNew = $oUserComment->skill + $voteValue * $iDelta;
            $iSkillNew = ($iSkillNew < 0) ? 0 : $iSkillNew;
            $oUserComment->skill = $iSkillNew;
            $oUserComment->save();
        }
    }

	public function setSkillTopicAuthor($topicAuthorId, $iValue) {
        
        /**
         * Начисляем силу и рейтинг автору топика, используя логарифмическое распределение
         */
        $iDelta = SkillService::countDeltaTopic(Auth::user()->skill);

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
