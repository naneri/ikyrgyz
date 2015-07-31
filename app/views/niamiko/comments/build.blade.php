@foreach($comments as $comment)
    @if($comment->parent_id == (($parent)?$parent->id:0))
        @include("{$template}comments.item", array('comment' => $comment, 'with_child' => true, 'parent' => $parent, 'sort' => $sort))
    @endif
@endforeach 
