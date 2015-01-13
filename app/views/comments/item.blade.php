<div class="comment_item" id="comment_{{$comment->id}}">
    <div class="comment_body" id="comment_body_{{$comment->id}}">
        @include('comments.body', array('comment' => $comment))
    </div>
    <div class="comments_child" id="comments_child_{{$comment->id}}" style="margin-left:20px;">
        @if($comment->childComments->count() > 0 && $with_child)
            @include('comments.build', array('comments' => $comment->childComments, 'parent_id' => $comment->id))
        @endif
    </div>
</div>