@extends('misc.layout')

@section('content')


<div class="b-content">
    <div class="b-user-profile">
        @if(isset($user->description->user_profile_avatar))
        <div class="b-user-profile__left"><a href="#" class="user-image"><img style="background: url('{{ asset($user->description->user_profile_avatar) }}') 50%; background-size: cover; width: 244px; height: 244px;"/></a>
            <p class="user-link-photo"><a href="#" id="upload_user_avatar">{{ trans('network.edit-photo') }}</a></p>
        </div>
        @else
        <div class="b-user-profile__left"><a href="#" class="user-image"><img style="background: url('{{asset("images/content/12.png")}}') 50%;background-size: cover; width: 244px; height: 244px;"/></a>
            <p class="user-link-photo"><a href="#" id="upload_user_avatar">{{ trans('network.upload-photo') }}</a></p>
        </div>
        @endif
        <div style="display: none;">
            {{Form::open(array('url' => URL::to('profile/uploadAvatar'), 'files' => true, 'id' => 'upload_avatar'))}}
                {{Form::file('avatar', array('accept' => 'image/*', 'id' => 'input_avatar'))}}
            {{Form::close()}}
        </div>

        <div class="b-user-profile__middle">
            @include('profile.show.info', compact('user', 'gender', 'marital_status'))
        </div>
        <div class="b-user-profile__right">
            <div class="b-user-profile-link"><a href="#" class="b-user-profile-link__create">{{ trans('network.create') }}</a></div>
            <ul class="b-user-profile-links">
                <li class="b-user-profile-links__list"><a href="{{URL::to('topic/create')}}"></a></li>
                <li class="b-user-profile-links__list"><a href="{{URL::to('blog/create')}}"></a></li>
                <li class="b-user-profile-links__list"><a href="{{URL::to('photoalbum/create')}}"></a></li>
                <!--li class="b-user-profile-links__list"><a href="#"></a></li>
                <li class="b-user-profile-links__list"><a href="#"></a></li>
                <li class="b-user-profile-links__list"><a href="#"></a></li>
                <li class="b-user-profile-links__list"><a href="#"></a></li-->
                <div class="clear"></div>
            </ul>
            <ul class="b-user-profile-buttons">
                <li class="b-user-profile-buttons__list"><a href="{{URL::to('messages/new')}}">{{ trans('network.send-message') }}<span class="msg-image"></span></a></li>
                <li class="b-user-profile-buttons__list"><a href="{{URL::to('search/people')}}">{{ trans('network.search-friends') }}<span class="search-image"></span></a></li>
                <li class="b-user-profile-buttons__list"><a href="#">{{ trans('network.system-messages') }}<span class="system-image"></span></a></li>
                <li class="b-user-profile-buttons__list"><a href="{{URL::to('profile/random')}}">{{ trans('network.random-profile') }}<span class="random-image"></span></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <div class="b-user-navigation">
        <ul class="b-user-navigation-list">
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/newsline')}}">{{ trans('network.timeline') }}</a></li>
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/publications')}}">{{ trans('network.publications') }}</a><span>{{$user->topics->count()}}</span></li>
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/friends')}}">{{ trans('network.friends') }}</a><span>{{$user->friends()->count()}}</span></li>
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/subscribtions')}}">{{ trans('network.subscriptions') }}</a></li>
            <a href="{{URL::to('profile/edit/main')}}" class="b-user-navigation-list__setting">{{ trans('network.settings') }}</a>
            <div class="clear"></div>
        </ul>
    </div>
    
    @include('profile.show.body', compact('items', 'page'))
    
        <div class="clear"></div>
    </div>
</div>

</div>
<script>
$(function(){
    $('#upload_user_avatar').click(function(){
        $('#input_avatar').click();
    });
    
    $('#input_avatar').change(function(){
        $('#upload_avatar').submit();
    });
});
</script>
@stop