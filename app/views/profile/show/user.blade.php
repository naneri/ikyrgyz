@extends('misc.layout')

@section('content')


<div class="b-content">
    <div class="b-user-profile">
        @if(isset($user->description->user_profile_avatar))
        <div class="b-user-profile__left"><a href="" class="user-image"><img  src="{{ asset($user->description->user_profile_avatar) }}" alt="" style="max-width: 244px;max-height: 244px;"/></a>
            <p class="user-link-photo"><a href="#">Загрузить фото</a></p>
        </div>
        @else
        <div class="b-user-profile__left"><a href="" class="user-image"><img  src="{{ asset('images/content/12.png') }}" alt=""/></a>
            <p class="user-link-photo"><a href="#">Загрузить фото</a></p>
        </div>
        @endif

        <div class="b-user-profile__middle">
            <p class="user-raiting">Рейтинг <span class="num">{{$user->rating}}</span></p>
            <p class="user-name">{{$user->getNames()}}</p>
        </div>
        <div class="b-user-profile__right">
            <ul class="b-user-profile-buttons">
                @if(!$friend_status)
                    <li class="b-user-profile-buttons__list"><a href="{{URL::to('people/friendRequest/'.$user->id)}}">Добавить в друзья<span class="search-image"></span></a></li>
                @else
                    <li class="b-user-profile-buttons__list"><a href="{{URL::to('messages/new?receiver='.$user->getNames())}}">Отправить сообщение<span class="msg-image"></span></a></li>
                @endif
                <li class="b-user-profile-buttons__list"><a style="height: 55px;line-height: 55px;" href="{{URL::to('profile/random')}}">Случайный профиль<span class="random-image"></span></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <div class="b-user-navigation">
        <ul class="b-user-navigation-list">
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/'.$user->id.'/newsline')}}">Лента</a></li>
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/'.$user->id.'/publications')}}">Публикации</a><span>{{$user->topics->count()}}</span></li>
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/'.$user->id.'/friends')}}">Друзья</a><span>{{$user->friends()->count()}}</span></li>
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/'.$user->id.'/subscribtions')}}">Подписки</a></li>
            <div class="clear"></div>
        </ul>
    </div>

    @include('profile.show.body', compact('items', 'page'))

    <div class="clear"></div>
</div>
</div>

</div>
@stop