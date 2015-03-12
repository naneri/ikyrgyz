@foreach($comments as $comment)
    @if($comment->parent_id == (($parent)?$parent->id:0))
        @include('comments.item', array('comment' => $comment, 'with_child' => true, 'parent' => $parent))
    @endif
@endforeach 
