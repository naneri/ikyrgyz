@foreach($comments as $comment)
    @if($comment->parent_id == $parent_id)
        @for($i = 0; $i < $deep; $i++)
            {{ '-' }}
        @endfor
        {{$comment->text}}<br>
        @if($comment->childComments->count() > 0)
            @include('comments.show', array('comments' => $comment->childComments, 'parent_id' => $comment->id, 'deep' => ++$deep))
            <?php --$deep;?>
        @endif
    @endif
@endforeach