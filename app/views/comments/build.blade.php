<div class="comments_child" id="comments_child_{{$parent_id}}">
    @foreach($comments as $comment)
        @if($comment->parent_id == $parent_id)
            @include('comments.item', array('comment' => $comment))
        @endif
    @endforeach
</div>

@if($parent_id == 0)
    <div class="add_comment" id="comment_0">
        <a href="#" onclick="comment.addForm(0)">Add comment</a>
        <div class="comment_body" id="comment_body_0"></div>
    </div>
@endif