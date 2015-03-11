<div class="comment_item" id="comment_{{$comment->id}}">
    <div class="comment_body" id="comment_body_{{$comment->id}}" style="margin:10px 0;">
        @include('comments.body', array('comment' => $comment))
        <div id="add_comment_{{$comment->id}}" class="reply_comment_form" style="display:none;">
            {{Form::textarea('comment', null, array('id' => 'reply_comment_'.$comment->id, 'class' => 'add_comment_text'))}}
            <input type="button" value="Опубликовать" class="default-button submit-button" onclick="comment.submit({{$comment->id}},{{$comment->topic_id}});">
        </div>
    </div>
    <div class="comments_child" id="comments_child_{{$comment->id}}" style="margin-left:20px;">
        @if($with_child)
            @include('comments.build', array('comments' => $comment->childCommentsWithUserData(), 'parent_id' => $comment->id))
        @endif
    </div>
</div>