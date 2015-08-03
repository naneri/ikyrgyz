<div class="b-profile-about-message__image">
    {{HTML::image(($comment->user_profile_avatar)?$comment->user_profile_avatar:asset('img/20.png'), null, array('style' => 'max-width:40px;max-height:40px;'))}}
    <p class="b-profile-about-message-button__raiting">{{number_format($comment->author_rating, 2)}}</p>
</div>
<div class="b-profile-about-message__message">
    <div class="b-profile-about-message-top">
        <a href="{{URL::to('profile/'.$comment->user_id)}}">
            <p class="b-profile-about-message-top__user">
                {{$comment->first_name.' '.$comment->last_name}}
            </p>
        </a>
        @if($parent)
            <p class="b-profile-about-message-top__user">
                <span style='color:#ccc;'>→ {{$parent->first_name.' '.$parent->last_name}}</span>
            </p>
        @endif
        <p class="b-profile-about-message-top__date">
            <span class="comment_time">{{$comment->created_at}}</span>
        </p>
        <div class="clear"></div>
    </div>
    @if($comment->trash)
    <div class="b-profile-about-message-text">
        <p class="b-profile-about-message-text__text">
            @if(Auth::id() == $comment->user_id || $isModerator)
            {{$comment->text}}
        <div class="b-profile-about-message-button">
            <input type="submit" value="{{ trans('network.restore') }}" class="button-default button-submit" onclick="comment.restore({{$comment->id}}); return false;">
        </div>
        @else
        {{ trans('network.comment-deleted') }}
        @endif
        </p>
    </div>
    @else
    <div class="b-profile-about-message-text">
        <p class="b-profile-about-message-text__text">
            @if($comment->rating > Config::get('social.topic_comment.hide_comment_rating'))
            <span id="comment_{{$comment->id}}_text">{{$comment->text}}</span>
            @else
            <span style="display: none;" id="comment_{{$comment->id}}_text">{{$comment->text}}</span>
            <span id="comment_{{$comment->id}}_hidden_text">{{ trans('network.com-low-rating') }}<a href="#" class="comment_reply" onclick="comment.show({{$comment->id}}); return false;">{{ trans('network.show') }}</a></span>
            @endif
        </p>
    </div>
    <div class="b-profile-about-message-button">
        @if(Auth::id() != $comment->user_id)
            <div class="b-profile-about-message-button__answer">
                <input type="submit" value="{{ trans('network.reply') }}" class="button-default button-submit" onclick="comment.replyForm({{$comment->id}}); return false;" />
            </div>
        @endif
        @if(Auth::id() == $comment->user_id || $isModerator)
            <div class="b-profile-about-message-button__delete">
                <input type="submit" value="{{ trans('network.delete') }}" class="button-default button-submit" onclick="comment.delete({{$comment->id}}); return false;"/>
            </div>
        @endif
        <!-- <div class="b-profile-about-message-button__minus">
            <input type="submit" class="button-default button-small" onclick="vote.comment({{$comment->id}}, - 1);"/>
        </div>
        <div class="b-profile-about-message-button__plus">
            <input type="submit" class="button-default button-small" onclick="vote.comment({{$comment->id}}, 1);"/>
        </div>
        <p class="b-profile-about-message-button__raiting" id="rating_comment_{{$comment->id}}">{{round($comment->rating,2)}}</p> -->
        @if(isset($comment->topic_id))
        <div class="b-user-wall-footer-raiting__right">
        <div class="b-user-wall-footer-raiting__arrow-down">
            <input type="button"onclick="vote.comment({{$comment->id}}, - 1);" class="btn-raiting">
        </div>
        <div class="b-user-wall-footer-raiting__number">
            <span class="number-raiting" id="rating_comment_{{$comment->id}}">{{round($comment->rating,2)}}</span>
        </div>
        <div class="b-user-wall-footer-raiting__arrow-up">
            <input type="button" onclick="vote.comment({{$comment->id}}, 1);" class="btn-raiting">
        </div>
        </div>
        @endif
        <div class="clear"></div>
        


    </div>
    @endif
</div>
<div id="add_comment_{{$comment->id}}" class="reply_comment_form" style="display:none; float: left; width: 500px;">
    {{Form::textarea('comment', null, array('id' => 'reply_comment_'.$comment->id, 'class' => 'add_comment_text'))}}
    <div class="b-profile-about-message-button">
        <input type="button" value="Опубликовать" class="button-default button-submit" onclick="comment.submit({{$comment->id}},{{$comment->topic_id}});">
    </div>
</div>