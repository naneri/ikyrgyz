<?php if(!isset($parent_id))$parent_id = 0; ?>

@foreach($topic->comments as $comment)
    @if($comment->parent_id == $parent_id)
        @include('comments.item', array('comment' => $comment, 'with_child' => true))
    @endif
@endforeach 

@if($parent_id == 0)
<div id="comment_body_0">
    <div class="b-profile-about__form" id="add_comment_form">
        <div class="b-profile-about-form" id="add_comment_0">
            <div class="b-profile-about-form__item"><a href="">
                    @if(isset($user_data->description->user_profile_avatar))
                    <img style="width:40px"src="{{ asset($user_data->description->user_profile_avatar) }}" alt="" class="b-profile-about-form__image"/>
                    @else
                    <img src="{{ asset('img/48.png') }}" alt="" class="b-profile-about-form__image"/>
                    @endif
                </a>
                <p class="b-profile-about-form__title">{{@$user_data->getNames()}}</p>
                <div class="clear"></div>
            </div>
            <div class="b-profile-about-form__item">
                <div class="b-profile-about-form__inner">
                    <textarea name="" cols="30" rows="10" class="add-comment" id="add_comment_text">Добавить комметарии</textarea>
                </div>
            </div>
            <div class="b-profile-about-form__item">
                <input type="submit" value="Отмена" class="default-button cancel-button" onclick="comment.addForm(0,{{$topic->id}});" />
                <input type="submit" value="Опубликовать" class="default-button submit-button" id="submit_btn" onclick="comment.submit(0,{{$topic->id}});"/>
            </div>
        </div>
    </div>
</div>
@endif