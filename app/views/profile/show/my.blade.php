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
            <p class="user-raiting">Рейтинг <span class="num">{{number_format($user->rating, 2)}}</span></p>
            <p class="user-name">{{$user->getNames()}}</p>
            <p class="user-date">{{$user->description->birthday}}</p>
        </div>
        <div class="b-user-profile__right">
            <div class="b-user-profile-link"><a href="#" class="b-user-profile-link__create">Создать</a></div>
            <ul class="b-user-profile-links">
                <li class="b-user-profile-links__list"><a href="{{URL::to('topic/create')}}"></a></li>
                <li class="b-user-profile-links__list"><a href="{{URL::to('blog/create')}}"></a></li>
                <!--li class="b-user-profile-links__list"><a href="#"></a></li>
                <li class="b-user-profile-links__list"><a href="#"></a></li>
                <li class="b-user-profile-links__list"><a href="#"></a></li>
                <li class="b-user-profile-links__list"><a href="#"></a></li>
                <li class="b-user-profile-links__list"><a href="#"></a></li-->
                <div class="clear"></div>
            </ul>
            <ul class="b-user-profile-buttons">
                <li class="b-user-profile-buttons__list"><a href="{{URL::to('messages/new')}}">Отравить сообщение<span class="msg-image"></span></a></li>
                <li class="b-user-profile-buttons__list"><a href="{{URL::to('search/people')}}">Поиск друзей<span class="search-image"></span></a></li>
                <li class="b-user-profile-buttons__list"><a href="#">Системные сообщения<span class="system-image"></span></a></li>
                <li class="b-user-profile-buttons__list"><a href="{{URL::to('profile/random')}}">Случайный профиль<span class="random-image"></span></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <div class="b-user-navigation">
        <ul class="b-user-navigation-list">
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/'.$user->id.'/newsline')}}">Лента</a></li>
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/'.$user->id.'/publications')}}">Публикации</a><span>{{$user->topics->count()}}</span></li>
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/'.$user->id.'/friends')}}">Друзья</a><span>{{$user->friends()->count()}}</span></li>
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/'.$user->id.'/subscribtions')}}">Подписки</a></li><a href="#" class="b-user-navigation-list__setting">Настройки</a>
            <div class="clear"></div>
        </ul>
    </div>
    <script>
    $(document).ready(function(){
        $('.b-user-media').prependTo(".masonry");
        var $container = $('.masonry');
        $container.imagesLoaded(function(){
                $container.masonry({
                    itemSelector: '.item',
                    columnWidth: 495,
                    gutter: 10,
                    stamp: '.b-user-media'
                });	
        });
    });
    </script>
    @include('topic.build', array('topics' => $items))
    @if($page == 'newsline')
    <div class="b-user-media item" style="right: 0px; padding-bottom: 100px;">
        <div class="b-user-media__video">
            <div class="b-user-media-video-top">
                <p class="b-user-media-video-top__title">Мое видео</p>
                <div class="b-user-media-video-top__btn">
                    <input type="submit" value="Все" class="btn btn-all"/>
                </div>
            </div>
            <ul class="b-user-media-video-gallery">
                <li class="b-user-media-video-gallery__list"><a href=""><img src="img/19.png" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="img/19.png" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="img/19.png" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="img/19.png" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="img/19.png" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="img/19.png" alt=""/></a></li>
                <div class="clear"></div>
            </ul>
        </div>
        <div class="b-user-media__photo">
            <div class="b-user-media-video-top">
                <p class="b-user-media-video-top__title">Мое фото</p>
                <div class="b-user-media-video-top__btn">
                    <input type="submit" value="Все" class="btn btn-all"/>
                </div>
            </div>
            <ul class="b-user-media-video-gallery">
                <li class="b-user-media-video-gallery__list"><a href=""><img src="img/19.png" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="img/19.png" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="img/19.png" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="img/19.png" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="img/19.png" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="img/19.png" alt=""/></a></li>
                <div class="clear"></div>
            </ul>
        </div>
        <div class="b-user-media__music">
            <div class="b-user-media-video-top">
                <p class="b-user-media-video-top__title">Моя музыка</p>
                <div class="b-user-media-video-top__btn">
                    <input type="submit" value="Все" class="btn btn-all"/>
                </div>
            </div>
            <ul class="b-user-media-video-gallery">
                <li class="b-user-media-video-gallery__list"><a href=""><img src="img/19.png" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="img/19.png" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="img/19.png" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="img/19.png" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="img/19.png" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="img/19.png" alt=""/></a></li>
                <div class="clear"></div>
            </ul>
        </div>
    </div>
    @endif
        <div class="clear"></div>
    </div>
</div>

</div>
@stop