<?php if(!isset($parent_id))$parent_id = 0; ?>
@foreach($comments as $comment)
    @if($comment->parent_id == $parent_id)
        @include('comments.item', array('comment' => $comment, 'with_child' => true))
    @endif
@endforeach 