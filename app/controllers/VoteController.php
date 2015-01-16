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
            
            $oComment = TopicComment::findOrFail(Input::get('comment_id'));
            $iValue = Input::get('value');
            
            if(!in_array($iValue, array('1', '-1'))){
                return Response::json(array('error' => 'Error!'));
            }
            
            $voteExists = Vote::where('target_type', 'comment')
                    ->where('user_id', Auth::user()->id)
                    ->where('target_id', $oComment->id)
                    ->exists();
            
            if($voteExists){
                return Response::json(array('error' => 'You already vote this comment!'));
            }
            
            if($oComment->user_id == Auth::user()->id){
                return Response::json(array('error' => 'You cannot vote this comment!'));
            }
            
            $this->setSkillCommentAuthor($oComment->user_id, $iValue);
            
            $oComment->rating += $iValue;
            $oComment->save();
            
            $this->createVote('comment', $oComment->id, $iValue, $oComment->rating);
                        
            return Response::json(array('rating' => $oComment->rating));
        }
        
        public function postVoteTopic(){
            
        }
        
        public function postVoteBlog(){
            
        }
        
        public function postVoteUser(){
            
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
            $oUserComment = User::findOrFail($commentAuthorId);
            $iSkillNew = $oUserComment->skill + $voteValue * $iDelta;
            $iSkillNew = ($iSkillNew < 0) ? 0 : $iSkillNew;
            $oUserComment->skill = $iSkillNew;
            $oUserComment->save();
        }

}