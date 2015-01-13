{{$comment->user->email}}<br>
@if($comment->trash)
    @if($comment->canView())
        {{$comment->text}}<br>
        <a href="#" class="comment_restore" onclick="comment.restore({{$comment->id}});return false;">Restore</a>
    @else
        Comment deleted<br>
    @endif
@else
    {{$comment->text}}<br>
    <a href="#" class="comment_reply" onclick="comment.addForm({{$comment->id}});return false;">Reply</a>
    @if($comment->canDelete())
        <a href="#" class="comment_delete" onclick="comment.delete({{$comment->id}});return false;">Delete</a>
    @endif
@endif