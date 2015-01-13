<?php if(!isset($parent_id))$parent_id = 0; ?>

<div class="comments_child" id="comments_child_{{$parent_id}}">
    @foreach($topic->comments as $comment)
        @if($comment->parent_id == $parent_id)
            @include('comments.item', array('comment' => $comment, 'with_child' => true))
        @endif
    @endforeach 
</div>

@if($parent_id == 0)
    <div class="add_comment" id="comment_0">
        <a href="#" onclick="comment.addForm(0, {{$topic->id}})">Add comment</a>
        <div class="comment_body" id="comment_body_0"></div>
    </div>
@endif