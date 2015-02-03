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
            $vote = new Vote();
            $vote->target_id = $targetId;
            $vote->target_type = $targetType;
            $vote->user_id = Auth::user()->id;
            $vote->value = $value;
            $vote->rating = $rating;
            $vote->save();
        }

        public function postVoteComment(){
            
            $oComment = TopicComment::find(Input::get('comment_id'));
            $iValue = Input::get('value');
            
            if(!$oComment){
                return Response::json(array('error' => 'comment not exists'));
            }
            
            if(!in_array($iValue, array('1', '-1')) ){
                return Response::json(array('error' => 'vote value error'));
            }
            
            $voteExists = Vote::where('target_type', 'comment')
                    ->where('user_id', Auth::user()->id)
                    ->where('target_id', $oComment->id)
                    ->exists();
            if($voteExists){
                return Response::json(array('error' => 'you already vote this comment'));
            }
            
            if($oComment->user_id == Auth::user()->id){
                return Response::json(array('error' => 'author cannot vote his comment'));
            }

            $oComment->vote($iValue);
            $oComment->save();
            
            $this->createVote('comment', $oComment->id, $iValue, $oComment->rating);
            $this->setSkillCommentAuthor($oComment->user_id, $iValue);
            
            return Response::json(array('rating' => $oComment->rating));
        }
        
        public function postVoteTopic(){
            $oTopic = Topic::find(Input::get('topic_id'));
            $iValue = Input::get('value');
            
            if (!$oTopic) {
                return Response::json(array('error' => 'topic not exists'));
            }

            if (!in_array($iValue, array('1', '-1'))) {
                return Response::json(array('error' => 'Error!'));
            }

            $voteExists = Vote::where('target_type', 'topic')
                    ->where('user_id', Auth::user()->id)
                    ->where('target_id', $oTopic->id)
                    ->exists();
            if ($voteExists) {
                return Response::json(array('error' => 'You already vote this topic!'));
            }

            if ($oTopic->user_id == Auth::user()->id) {
                return Response::json(array('error' => 'You cannot vote this topic!'));
            }
            
            $oTopic->vote($iValue);
            $oTopic->save();
            
            $this->createVote('topic', $oTopic->id, $iValue, $oTopic->rating);
            $this->setSkillTopicAuthor($oTopic->user_id, $iValue);
            
            return Response::json(array('rating' => $oTopic->rating));
        }
        
        public function postVoteBlog(){
            $oBlog = Blog::find(Input::get('blog_id'));
            $iValue = Input::get('value');

            if (!$oBlog) {
                return Response::json(array('error' => 'blog not exists'));
            }

            if (!in_array($iValue, array('1', '-1'))) {
                return Response::json(array('error' => 'Error!'));
            }

            $voteExists = Vote::where('target_type', 'blog')
                    ->where('user_id', Auth::user()->id)
                    ->where('target_id', $oBlog->id)
                    ->exists();
            if ($voteExists) {
                return Response::json(array('error' => 'You already vote this blog!'));
            }

            if ($oBlog->user_id == Auth::user()->id) {
                return Response::json(array('error' => 'You cannot vote this topic!'));
            }

            $oBlog->vote($iValue);
            $oBlog->save();

            $this->createVote('blog', $oBlog->id, $iValue, $oBlog->rating);

            return Response::json(array('rating' => $oBlog->rating));
        }
        
        public function postVoteUser(){
            $oUser = User::findOrFail(Input::get('user_id'));
            $iValue = Input::get('value');

            if (!in_array($iValue, array('1', '-1'))) {
                return Response::json(array('error' => 'Error!'));
            }

            $voteExists = Vote::where('target_type', 'user')
                    ->where('user_id', Auth::user()->id)
                    ->where('target_id', $oUser->id)
                    ->exists();

            if ($voteExists) {
                return Response::json(array('error' => 'You already vote this blog!'));
            }

            if ($oUser->id == Auth::user()->id) {
                return Response::json(array('error' => 'You cannot vote this topic!'));
            }

            $oUser->vote($iValue);
            $oUser->save();

            $this->createVote('user', $oUser->id, $iValue, $oUser->rating);
            $this->setSkillUser($oUser->id, $iValue);

            return Response::json(array('rating' => $oUser->rating));
        }

        private function setSkillCommentAuthor($commentAuthorId, $voteValue) {
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
                $iSkillNew = $oUserComment->skill + $voteValue * $iDelta;
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
