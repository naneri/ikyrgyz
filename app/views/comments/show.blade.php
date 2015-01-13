@foreach($comments as $comment)
@if($comment->parent_id == $parent_id)
<div class="comment_item" id="comment_{{$comment->id}}">
    <span class="parent_id" data-parent_id="{{$comment->parent_id}}"></span>
    <div class="comment_body" id="comment_body_{{$comment->id}}">
        {{$comment->user->email}}<br>
        {{$comment->text}}<br>
        <a href="#" class="comment_reply" onclick="comment.addForm({{$comment->id}});return false;">Reply</a>
        @if($comment->canDelete())
        <a href="#" class="comment_delete" onclick="comment.delete({{$comment->id}});return false;">Delete</a>
        @endif
    </div>
    <div class="reply_comments" id="comments_reply_{{$comment->id}}" style="margin-left:20px;">
        @if($comment->childComments->count() > 0)
            @include('comments.show', array('comments' => $comment->childComments, 'parent_id' => $comment->id))
        @endif
    </div>
</div>
@endif
@endforeach