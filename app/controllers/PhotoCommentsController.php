<?php

class PhotoCommentsController extends \BaseController {

	/**
	 * Show the form for adding a new topiccomment
	 *
	 * @return Response
	 */
	public function postAdd()
	{
        $result = array();

        $validator = Validator::make($data = Input::all(), PhotoComment::$rules);

        if ($validator->fails()) {
            $result['status'] = "error";
            $result['message'] = $validator;
        } else {
            $data['user_id'] = Auth::user()->id;
            
            $comment = PhotoComment::create($data);
            $commentWithUserData = $comment->withUserData();
            $bonusRating = new BonusRating();
            $commentWithUserData->author_rating += $bonusRating->getUsersBonusRating($comment->user_id);
            
            $result['comment']      = $this->makeView('comments.item', array('comment' => $commentWithUserData, 'parent' => null, 'with_child' => false))->render();
            $result['comment_id']   = $comment->id;
            $result['message']      = "Комментарий успешно добавлен";
            $result['status']       = "success";
            
            $photo = Photo::find($data['photo_id']);
            
            $anyCommentCreated = BonusRating::where('target_type', 'photo_comment')
                                            ->where('user_id', Auth::user()->id)
                                            ->exists();
            if ($anyCommentCreated) {
                BonusRating::addBonusRating('photo_comment', $photo->id, Config::get('bonus_rating.comment'));
            } else {
                BonusRating::addBonusRating('photo_comment', $photo->id, Config::get('bonus_rating.first_comment'));
            }
        }

        if(Request::ajax()){
                return Response::json($result);
        }
        Debugbar::info($result['error']);
        Debugbar::error('Error!');
        return Redirect::back()->with('errors');
    }
        

	/**
	 * Remove the specified topiccomment from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postDelete()
	{
        $result = array();
        $comment = PhotoComment::find(Input::get('comment_id'));
        if($comment->canDelete()){
            $comment->trash = true;
            $comment->save();
            $commentWithUserData = $comment->withUserData();
            $bonusRating = new BonusRating();
            $commentWithUserData->author_rating += $bonusRating->getUsersBonusRating($comment->user_id);
            $result['comment'] = $this->makeView('comments.item', array('comment' => $commentWithUserData, 'parent' => $comment->parentWithUserData(), 'with_child' => false))->render();
            $result['message'] = "Комментарий удален";
            $result['status'] = "success";
        } else {
            $result['status'] = "error";
            $result['message'] = "У вас нет прав на удаление этого комментария";
        }
        return Response::json($result);
	}

	/**
    * Restore the specified topiccomment from storage.
    *
    * @param  int  $id
    * @return Response
    */
   public function postRestore() {
            $result = array();
            $comment = PhotoComment::find(Input::get('comment_id'));
            if ($comment->canRestore()) {
                $comment->trash = false;
                $comment->save();
                $commentWithUserData = $comment->withUserData();
                $bonusRating = new BonusRating();
                $commentWithUserData->author_rating += $bonusRating->getUsersBonusRating($comment->user_id);
                $result['comment'] = $this->makeView('comments.item', array('comment' => $commentWithUserData, 'parent' => $comment->parentWithUserData(), 'with_child' => false))->render();
                $result['comment_id'] = $comment->id;
                $result['message'] = "Комментарий восстановлен";
                $result['status'] = "success";
            } else {
                $result['status'] = "error";
                $result['message'] = "У вас нет прав на восстановление этого комментария";
            }
            return Response::json($result);
       }

	/**
    * Restore the specified topiccomment from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function sortComments() {
        $photo = Photo::find(Input::get('photo_id'));
        $comments = $photo->commentsWithDataSortBy(Input::get('sort_by'));
        $result = array();
        if($comments->count() > 0){
            $result['comments'] = $this->makeView('comments.build', array('comments' => $comments, 'parent' => null, 'sort' => Input::get('sort_by')))->render();
            $result['message'] = "Комментарии отсортированы";
            $result['status'] = 'success';
        }else{
            $result['status'] = 'warn';
            $result['message'] = "Комментариев к топику пока нет";
        }
        return Response::json($result);
    }

}
