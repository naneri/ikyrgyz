<div class="b-profile-about__message" id="comment_{{$comment->id}}">
    <div class="b-profile-about-message">
        <div id="comment_body_{{$comment->id}}">
            @include("{$template}comments.body", array('comment' => $comment, 'parent' => $parent))
        </div>
        <div class="clear"></div>
        <div class="b-profile-about-message b-profile-about-message_margin" id="comments_child_{{$comment->id}}">
            @if($with_child)
                @include("{$template}comments.build", array('comments' => $comment->childCommentsSortBy($sort), 'parent' => $comment))
            @endif
        </div>
    </div>
</div>