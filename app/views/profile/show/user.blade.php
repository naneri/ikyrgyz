@extends('misc.layout')

@section('content')


<div class="b-content">
    <div class="b-user-profile">
        @if(isset($user->description->user_profile_avatar))
        <div class="b-user-profile__left"><a href="#" class="user-image">
                <img style="background: url('{{ asset($user->description->user_profile_avatar) }}') 50%; background-size: cover; width: 244px; height: 244px;" />
        </div>
        @else
        <div class="b-user-profile__left"><a href="#" class="user-image"><img   style="background: url('{{asset("images/content/12.png")}}') 50%;background-size: cover; width: 244px; height: 244px;"/></a>
        </div>
        @endif

        <div class="b-user-profile__middle">
            @include('profile.show.info', compact('user', 'gender', 'marital_status'))
        </div>
        <div class="b-user-profile__right">
            <ul class="b-user-profile-buttons">
                @if(!$friend_status)
                    <li class="b-user-profile-buttons__list"><a href="{{URL::to('people/friendRequest/'.$user->id)}}">{{ trans('network.add-to-friends') }}<span class="search-image"></span></a></li>
                @else
                    <li class="b-user-profile-buttons__list"><a href="{{URL::to('messages/new?receiver='.$user->getNames())}}">{{ trans('network.send-message') }}<span class="msg-image"></span></a></li>
                @endif
                <li class="b-user-profile-buttons__list"><a style="height: 55px;line-height: 55px;" href="{{URL::to('profile/random')}}">{{ trans('network.random-profile') }}<span class="random-image"></span></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <div class="b-user-navigation">
        <ul class="b-user-navigation-list">
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/'.$user->id.'/newsline')}}">{{ trans('network.timeline') }}</a></li>
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/'.$user->id.'/publications')}}">{{ trans('network.publications') }}</a><span>{{$user->topics->count()}}</span></li>
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/'.$user->id.'/friends')}}">{{ trans('network.friends') }}</a><span>{{$user->friends()->count()}}</span></li>
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/'.$user->id.'/subscribtions')}}">{{ trans('network.subscriptions') }}</a></li>
            <div class="clear"></div>
        </ul>
    </div>

    @include('profile.show.body', compact('items', 'page'))

    <div class="clear"></div>
</div>
</div>

</div>
@stop