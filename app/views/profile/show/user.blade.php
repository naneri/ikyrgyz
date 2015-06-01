@extends('misc.layout')

@section('content')
<div class="b-content">

<div class="b-profile">
    <div class="b-profile__left">
        <div class="b-profile-photo">
            <div class="b-profile-photo__image">
                <a href="{{asset($user->avatar())}}" class="user-image">
                    <img src="{{asset($user->avatar())}}" style="width: 244px; height: 244px;" />
                </a>
            </div>
            <script>
                $(document).ready(function(){
                    $('.b-user-profile .b-user-profile__left').photobox('a', {thumbs: false, autoplayBtn: false,});
                });
            </script>
        </div>
    </div>
    <div class="b-profile__right">
        <div class="b-profile-top">
            <div class="b-profile-top__left">
                <div class="b-profile-top-information">
                    <div class="b-profile-top-information__top"><span class="raiting-text">Рейтинг:</span><span class="raiting-num">+{{$user->rating}}</span></div>
                    <div class="b-profile-top-information__name">{{$user->getNames()}}</div>
                    <div class="b-profile-top-information__status"></div>
                </div>

            </div>

            <div class="b-profile-top__right">
                <div class="b-profile-top-button">
                    <a href="{{URL::to('profile/random')}}" class="b-profile-top-button__button">Случайный профиль</a>

                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="b-profile-middle">

            <ul>
                <li class="b-profile-middle__left">
                    @if($user->description->age())
                    <p>День рождения:</p>
                    @endif
                    @if($user->description->getLiveplace())
                    <p>Живет:</p>
                    @endif
                    <?php $jobs = $user->profileItemsGetValues('job'); ?>
                    @if(count($jobs) > 0)
                    <p>Работает</p>
                    @endif
                </li>
                <li class="b-profile-middle__right">
                    @if($user->description->age())
                    <p>{{$user->description->birthday}}</p>
                    @endif
                    @if($user->description->getLiveplace())
                        <p>{{$user->description->getLiveplace()}}</p>
                    @endif
                    @if(count($jobs) > 0)
                    <p>
                        @foreach($jobs as $job)
                        {{$job}}
                        @endforeach
                    </p>
                    @endif
                </li>

                <div class="clear"></div>
            </ul>
            <div class="b-profile-middle__button">Показать полную информацию</div>
        </div>
        <div class="b-profile-counters">
            <ul>
                @if($friends->count() > 0)
                <li>
                    <a href="{{URL::to('profile/'.$user->id.'/friends')}}">
                        <p>{{$friends->count()}}</p>
                        <p>Друзей</p>
                    </a>
                </li>
                @endif
                @if($user->id != Auth::id() && $mutualFriends->count() > 0)
                <li><a href="{{URL::to('profile/'.$user->id.'/mutualFriends')}}">
                        <p>{{$mutualFriends->count()}}</p>
                        <p>Общих</p>
                    </a></li>
                @endif
                @if($subscribers->count() > 0)
                <li><a href="{{URL::to('profile/'.$user->id.'/subscribers')}}">
                        <p>{{$subscribers->count()}}</p>
                        <p>Подписчиков</p>
                    </a></li>
                @endif
                @if($photos->count() > 0)
                <li><a href="{{URL::to('profile/'.$user->id.'/photos')}}">
                        <p>{{$photos->count()}}</p>
                        <p>Фотографии</p>
                    </a></li>
                @endif
                @if($videos->count() > 0)
                <li><a href="{{URL::to('profile/'.$user->id.'/videos')}}">
                        <p>{{$videos->count()}}</p>
                        <p>Видео</p>
                    </a></li>
                @endif
                <div class="clear"></div>
            </ul>
        </div>
    </div>
    <div class="clear"></div>

</div>
<div class="b-user-navigation">
    <div class="b-user-navigation-list">
        <ul class="tabs">
            <li class="b-user-navigation-list__list tab-link current" data-tab="tab-1" ><a href="{{URL::to('profile/'.$user->id)}}">Лента</a></li>
            <li class="b-user-navigation-list__list" data-tab="tab-4"><a href="{{URL::to('profile/'.$user->id.'/publications')}}">Публикации</a><span>{{$user->publications(10000)->count()}}</span></li>
            <li class="b-user-navigation-list__list" data-tab="tab-3"><a href="{{URL::to('profile/'.$user->id.'/friends')}}">Друзья</a><span>{{$user->friends()->count()}}</span></li>
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/'.$user->id.'/subscriptions')}}">Подписано</a><span>{{$user->subscriptions()->count()}}</span></li>
            <div class="clear"></div>
        </ul>
    </div>
</div>

@include('profile.show.body', compact('items', 'page'))
</div>
@stop