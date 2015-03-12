<div>
    {{HTML::image(($comment->user_profile_avatar)?$comment->user_profile_avatar:asset('img/48.png'), null, array('style' => 'max-width:40px;max-height:40px;float:left;margin-right:10px;'))}}
    <span style="line-height: 40px;" class="b-profile-about-text__text" >{{$comment->first_name.' '.$comment->last_name}}</span>
    @if($parent)
        <span style='color:#ccc;'>→ {{$parent->first_name.' '.$parent->last_name}}</span>
    @endif
    <span style="margin-left:20px;font-size: 10px; font-family: 'PT sans caption'; color: #aaa;" class="comment_time">{{$comment->created_at}}</span>
</div>
    @if($comment->trash)
        @if(Auth::id() == $comment->user_id || $isModerator)
        <div style="margin:10px 0;" class="b-profile-about-text__text">{{$comment->text}}</div><br>
            <a href="#" class="comment_restore" onclick="comment.restore({{$comment->id}});return false;">Восстановить</a>
        @else
            Комментарий удален<br>
        @endif
    @else
    <div style="margin:10px 0;" class="b-profile-about-text__text">
        @if($comment->rating > Config::get('social.topic_comment.hide_comment_rating'))
            <span id="comment_{{$comment->id}}_text">{{$comment->text}}</span>
        @else
            <span style="display: none;" id="comment_{{$comment->id}}_text">{{$comment->text}}</span>
            <span id="comment_{{$comment->id}}_text_show_msg">Комментарий скрыт из-за низкого рейтинга <a href="#" class="comment_reply" onclick="comment.show({{$comment->id}});return false;">Показать</a></span>
        @endif
    </div>
    <div style="width: 300px;height: 35px;line-height: 35px;">
            <a href="#" class="comment_reply" onclick="comment.replyForm({{$comment->id}});return false;">Ответить</a>
            @if(Auth::id() == $comment->user_id || $isModerator)
                <a href="#" class="comment_delete" onclick="comment.delete({{$comment->id}});return false;">Удалить</a>
            @endif

            <div class="b-profile-about-tags-user__right">
                <ul class="b-profile-about-tags-user-list dropdown">
                    <li><a href="" class="share-btn btn"></a>
                        <ul class="b-profile-about-tags-user-list-dropdown sub-dropdown" style="display: none;">
                            <li><a href="">Facebook</a></li>
                            <li><a href="">Google+</a></li>
                            <li><a href="">Twitter</a></li>
                            <li><a href="">Мой мир</a></li>
                            <li><a href="">В контакте</a></li>
                        </ul>
                    </li>
                </ul>
                <input type="submit" class="btn btn-minus" onclick="vote.comment({{$comment->id}}, -1);">
                <input type="submit" class="btn btn-plus" onclick="vote.comment({{$comment->id}}, 1);">
                <span class="likes" id="rating_comment_{{$comment->id}}">{{$comment->rating}}</span>
            </div>
        </div>
    @endif