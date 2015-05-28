@include('scripts.photobox')

@if($page == 'newsline')
    @include('scripts.script-topic', array('page' => '/profile/'.$user->id.'/ajaxTopics/', 'columnN' => false))
    @include('topic.build', array('topics' => $items, 'showCreatePanel' => $user->id == Auth::id()))
@elseif($page == 'publications' || $page == 'videos')
    @include('scripts.script-topic', array('page' => '/profile/'.$user->id.'/ajaxTopics/', 'columnN' => 2))
    @include('topic.build', array('topics' => $items))
@elseif($page == 'favourites')
    @include('profile.show.build.favourite', compact('items'))
@elseif($page == 'subscriptions')
    @include('blog.build', array('blogs' => $items))
    @include('blog.scripts', array('page' => 'profile/'.$user->id.'/subscriptions'))
@elseif($page == 'friends')
<div class="b-friends tab-content current" id="tab-4" class="tab-content">

    <div class="b-friends-sort">
        <div class="b-friends-sort__left">			
            <span class="b-friends-sort__text">Сортировать</span>
            <div class="b-friends-sort__sort">
                <a href="#" class="button-select">Все</a>
                <div class="b-friends-sort-list dropdown">
                    <ul class="dropdown">
                        <li class="b-friends-sort-list__list">Семья <span>0</span><a href=""></a></li>
                        <li class="b-friends-sort-list__list">Лучшие друзья <span>0</span><a href=""></a></li>
                        <li class="b-friends-sort-list__list">Коллеги <span>0</span><a href=""></a></li>
                        <li class="b-friends-sort-list__list">Знакомые <span>0</span><a href=""></a></li>
                        <li class="b-friends-sort-list__list">Все <span>0</span><a href=""></a></li>
                        <li class="b-friends-sort-list__list">Добавить категорию <a href=""></a></li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="b-friends-sort__right">
            <span class="b-friends-sort__text">
                Заблокированные
            </span>
        </div>
        <div class="clear"></div>

    </div>
    <div class="b-friends-inner">

        <div class="b-friends-inner__left">
            <?php
            $i = 1;
            //while ($i <= 4) {
                ?>
            @foreach($items as $user)
                <div class="b-friends-block">
                    <div class="b-friends-block__left">
                        <div class="b-friends-block-image">
                            <img src="{{asset(($user->user_profile_avatar) ? $user->user_profile_avatar : asset('img/106.png'))}} " alt="" class="b-friends-block-image__image">
                            <a href="{{URL::to('messages/new?receiver='.$user->first_name.'+'.$user->last_name)}}" class="b-friends-block-image__button ">Сообщение</a>
                        </div>
                    </div>
                    <div class="b-friends-block__right">
                        <div class="b-friends-block-info"><a href="{{URL::to('profile/'.$user->id)}}">
                            <div class="b-friends-block-info__name">{{$user->first_name}} <p>{{$user->last_name}}</p></div></a>
                            <div class="b-friends-block-info__amount">{{$user->friends()->count()}} друзей</div>
                            <div class="b-friends-block-info__counter">
                                <ul class="b-friends-block-info-counters-list">
                                    <li class="b-friends-block-info-counters-list__list">
                                        <img src="{{asset('img/110.png') }}" alt=""><span>{{$user->publications()->count()}}</span>
                                    </li>
                                    <li class="b-friends-block-info-counters-list__list">
                                        <img src="{{asset('img/111.png') }}" alt=""><span>{{$user->canPublishBlogs()->count()}}</span></li>
                                    <li class="b-friends-block-info-counters-list__list">
                                        <img src="{{asset('img/112.png') }}" alt=""><span>{{$user->photos()->count()}}</span>
                                    </li>
                                    <!--li class="b-friends-block-info-counters-list__list">
                                        <img src="{{asset('img/114.png') }}" alt=""><span>999</span>
                                    </li-->
                                    <div class="clear"></div>
                                </ul>
                            </div>
                            <div class="b-friends-block-info__edit">
                                <a href="" class="button-select ">Редактировать</a>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            @endforeach
                <?php
//                $i = $i + 1;
//            }
            ?>	
        </div>

        <div class="b-friends-inner__right">
            <div class="b-friends-common-wrapper">
                <div class="b-friends-common-wrapper__inner">
                    <div class="b-friends-common">
                        <div class="b-friends-common-top">
                            <div class="b-friends-common-top__title">Общие друзья <span>999</span></div>
                            <div class="b-friends-common-top__button">
                                <input type="submit" value="Все" class="button-all">
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="b-friends-common-list">
                            <ul>
                                <li class="b-friends-common-list__list"><a href=""><img src="{{asset('img/59.png') }}" alt=""></a></li>
                                <li class="b-friends-common-list__list"><a href=""><img src="{{asset('img/59.png') }}" alt=""></a></li>
                                <li class="b-friends-common-list__list"><a href=""><img src="{{asset('img/59.png') }}" alt=""></a></li>
                                <div class="clear"></div>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="b-friends-common-wrapper__inner">
                    <div class="b-friends-common">
                        <div class="b-friends-common-top">
                            <div class="b-friends-common-top__title">Возможно вы их знаете <span>999</span></div>
                            <div class="b-friends-common-top__button"><input type="submit" value="Все" class="button-all"></div>

                            <div class="clear"></div>
                        </div>
                        <div class="b-friends-common-list">
                            <ul>
                                <li class="b-friends-common-list__list"><a href=""><img src="{{asset('img/59.png') }}" alt=""></a></li>
                                <li class="b-friends-common-list__list"><a href=""><img src="{{asset('img/59.png') }}" alt=""></a></li>
                                <li class="b-friends-common-list__list"><a href=""><img src="{{asset('img/59.png') }}" alt=""></a></li>
                                <div class="clear"></div>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>


        </div>
        <div class="clear"></div>
    </div>

</div>
@elseif($page == 'mutualFriends' || $page == 'subscribers')
    @include('scripts.script-topic', array('page' => '/profile/'.$user->id.'/ajaxTopics/', 'columnN' => 2))
    <div class="masonry">
        @foreach($items as $user)
            <div class="item" style="padding: 10px; border: 1px solid #d8d8d8; background: #fff;width:470px;">
                <a href="{{URL::to('profile/'.$user->id)}}">
                    <img src="{{asset(($user->user_profile_avatar) ? $user->user_profile_avatar : asset('img/48.png'))}}" style="float:left;width:60px;height:60px;margin-right: 10px;" /> 
                    <div>{{$user->first_name}} {{$user->last_name}}</div>
                </a>
                <div>{{date_diff(date_create(@$user->birthday), date_create('today'))->y;}}, {{@$user->country}}</div>
                <div>
                    [{{HTML::link('profile/'.$user->id, 'Посмотреть профиль')}}]
                    @if(Friend::checkIfFriend($user->id, Auth::id()))
                        [{{HTML::link('messages/new?receiver='.$user->first_name.'+'.$user->last_name, 'Написать сообщение')}}]
                    @else
                        [{{HTML::link('people/friendRequest/'.$user->id, 'Подружиться')}}]
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@elseif($page == 'messages')
<div class="b-message tab-content current">
    <div class="b-message-tabs">
        <div class="b-message-tabs-list">
            <ul class="tab">
                <li class="b-message-tabs-list__list tab-link currents" data-tab="tabs-1" ><a href="#"><img src="{{asset('img/115.png') }}" alt="">Личные сообщения</a></li>
                <li class="b-message-tabs-list__list" data-tab="tabs-2"><a href="#"><img src="{{asset('img/116.png') }}" alt="">Новые друзья</a></li>
                <li class="b-message-tabs-list__list"><a href=""><img src="{{asset('img/117.png') }}" alt="">Оповещения</a></li>
                <div class="clear"></div>
            </ul>
        </div>
    </div>
    <div class="b-message-ls tab-contents currents" id="tabs-1">
        <div class="b-message-ls__left">
            <div class="b-message-ls-button">
                <input type="submit" class="b-message-ls-button__item" value="Новое сообщение">
            </div>
            <div class="b-message-ls-list">
                <ul>
                    <li class="b-message-ls-list__list"><a href="">Контакты</a><span>0</span></li>
                    <li class="b-message-ls-list__list"><a href="">Входящие</a><span>{{$new_messages->count()}}</span></li>
                    <li class="b-message-ls-list__list"><a href="">Отправленные</a></li>
                    <li class="b-message-ls-list__list"><a href="">Черный список</a></li>
                    <li class="b-message-ls-list__list"><a href="">Удаленные</a></li>
                    <li class="clear"></li>
                </ul>
            </div>
        </div>
        <div class="b-message-ls__right">
            <div class="b-message-ls-mark">
                <table>
                    <tr>
                        <td>
                            <ul>
                                <li class="b-message-ls-mark__list">
                                    <div class="b-message-ls-mark__checkbox">
                                        <input type="checkbox" >
                                    </div>
                                </li>
                                <li class="b-message-ls-mark__list b-message-ls-mark__list_border-right">
                                    <div class="b-message-ls-mark-button">
                                        <a href="#" class="b-message-ls-mark-button__item button-select">Прочитанное</a>
                                        <div class="b-message-ls-mark-button-list dropdown">
                                            <ul>
                                                <li class="b-message-ls-mark-button-list__item"><a href="">Все прочитанны</a></li>
                                                <li class="b-message-ls-mark-button-list__item"><a href="">Все непрочитанны</a></li>
                                                <li class="b-message-ls-mark-button-list__item"><a href="">Черный список</a></li>
                                                <li class="b-message-ls-mark-button-list__item"><a href="">Удаленные</a></li>
                                            </ul>
                                        </div>
                                        <input type="submit" class="b-message-ls-mark-button__item button-make" value="Выполнить">
                                    </div>
                                </li>
                                <li class="b-message-ls-mark__list b-message-ls-mark__list_sort">
                                    <a href="">Все</a>
                                    <a href="">Друзья</a>
                                    <a href="">Группы</a>
                                    <a href="">События</a>
                                </li>
                                <li class="b-message-ls-mark__list b-message-ls-mark__list_last">
                                    <a href=""><img src="{{asset('img/refresh-icon.png')}}" alt=""></a>
                                </li>
                                <div class="clear"></div>
                            </ul>
                        </td>

                    </tr>
                    @foreach($items as $message)
                    <tr>
                        <td>
                            <ul>
                                <li class="b-message-ls-mark__list b-message-ls-mark__list_second">
                                    <div class="b-message-ls-mark__checkbox b-message-ls-mark__checkbox_second">
                                        {{Form::checkbox('messages[]', $message->id)}}
                                    </div>
                                </li>
                                <li class="b-message-ls-mark__list">
                                    <div class="b-message-ls-mark__image">
                                        <img style="width: 50px;height:50px;" src="{{($message->sender_id == Auth::id())?$message->receiver->avatar():$message->sender->avatar()}}" alt="">
                                    </div>
                                </li>
                                <li class="b-message-ls-mark__list">
                                    <div class="b-message-ls-mark-desc">
                                        <a href="{{URL::to('message/show/' . $message->id)}}">
                                        <div class="b-message-ls-mark-desc__title">{{mb_substr(strip_tags($message->text), 0, 200, 'UTF-8') }}</div>
                                        </a>
                                        <div class="b-message-ls-mark-desc__name">
                                            {{($message->sender_id == Auth::id())?$message->receiver->getNames():$message->sender->getNames()}}</div>
                                    </div>	
                                </li>
                                <li class="b-message-ls-mark__list">
                                    <div class="b-message-ls-mark-num">
                                        <div class="b-message-ls-mark-num__image" style="height: auto;"><img src="{{asset('img/119.png')}}" alt=""></div>
                                        <span>{{date_format($message->created_at, 'd M')}}</span>
                                    </div>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="b-message-friends tab-contents" id="tabs-2" >
        <div class="b-message-friends__left">
            <div class="b-message-friends-block">
                <div class="b-message-friends-block__left">
                    <div class="b-message-friends-block-image">
                        <img src="{{asset('img/107.png')}}" alt="" class="b-message-friends-block-image__image">
                        <input type="submit" value="Сообщение" class="b-message-friends-block-image__button btn-gray" >
                    </div>
                </div>
                <div class="b-message-friends-block__right">
                    <div class="b-message-friends-info">
                        <div class="b-message-friends-info__name">Бобровский Сергей</div>
                        <div class="b-message-friends-info__notification">Предлагает вам дружбу</div>
                        <div class="b-message-friends-info__counts">
                            <ul>
                                <li class="b-message-friends-info-counts__list">
                                    <span>58</span>
                                    <span>Друзей</span>
                                </li>
                                <li class="b-message-friends-info-counts__list"><span>8</span><span>друзей</span></li>
                                <li class="b-message-friends-info-counts__list">
                                    <img src="{{asset('img/110.png')}}" alt="">
                                    <span class="red-counter">999</span>
                                </li>
                                <li class="b-message-friends-info-counts__list">
                                    <img src="{{asset('img/111.png')}}" alt="">
                                    <span class="red-counter">999</span>
                                </li>
                                <li class="b-message-friends-info-counts__list">
                                    <img src="{{asset('img/112.png')}}" alt="">
                                    <span class="red-counter">999</span>
                                </li>
                                <li class="b-message-friends-info-counts__list">
                                    <img src="{{asset('img/114.png')}}" alt="">
                                    <span class="red-counter">999</span>
                                </li>
                                <div class="clear"></div>
                            </ul>
                        </div>
                        <div class="b-message-friends-info-button">
                            <input type="submit" value="Отклонить" class="b-message-friends-info-button__button btn-gray">
                            <input type="submit" value="Принять" class="b-message-friends-info-button__button btn-gray">
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="b-message-friends__right">
            <div class="b-message-friends-search">
                <div class="b-message-friends-search__title">Поиск друзей</div>
                <div class="b-message-friends-search-inner">
                    <ul>
                        <li class="b-message-friends-search-inner__list">
                            <div class="friend-search-group">
                                <input type="text" value="Поиск людей" class="friend-input">
                                <input type="submit" class="friend-button">
                            </div>

                        </li>
                        <li class="b-message-friends-search-inner__list">
                            <div class="search-title">Место поска</div>
                            <div class="select-group">
                                <select name="" id="" class="select-default select-country" data-placeholder="Страна">
                                    <option value="">Страна</option>
                                </select>
                            </div>
                            <div class="select-group select">
                                <select name="" id="" class="select-default select-country" data-placeholder="Город">
                                    <option value="">Город</option>
                                </select>
                            </div>
                            <div class="select-group">
                                <input type="text" value="Нет в списке" class="noinlist"></div>
                        </li>
                        <li class="b-message-friends-search-inner__list">
                            <div class="search-title">Учебные заведения</div>
                            <div class="input-group">
                                <input type="text" value="Школа, ВУЗ" class="school-field">
                            </div>
                        </li>
                        <li class="b-message-friends-search-inner__list">
                            <div class="search-title">Пол</div>
                            <div class="select-group">
                                <ul>
                                    <li class="select-male__list"><a href="">Мужской</a></li>
                                    <li class="select-male__list"><a href="">Женский</a></li>
                                    <li class="select-male__list"><a href="">Любой</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="b-message-friends-search-inner__list">
                            <div class="search-title">Возраст</div>
                            <div class="select-group">
                                <select name="" id="" class="select-default select-age" data-placeholder="От">
                                    <option value=""></option>
                                </select>
                                <span>-</span>
                                <select name="" id="" class="select-default select-age" data-placeholder="До">
                                    <option value="">До</option>
                                </select>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
        <div class="clear"></div>
    </div>
</div>
@endif

@if($page == 'newsline' || $page == 'publications')
    <script>
        $(document).ready(function() {
            //$('.b-user-media').prependTo(".masonry");
            $('.masonry').css({'width': '495px', 'float': 'left'});
            $('.video-item').each(function(){
                var $video = $(this).find('div.youtube');
                $video = $video.find('object').attr('width', '120').attr('height', '120');
                $(this).html($video);
            });
        });
        
        $(function(){
            var $stickBox = $('.sticky-box');
            var mediaTop = $stickBox.offset().top;
            $(window).scroll(function(){
                var scroll = $(window).scrollTop();
                if(scroll>mediaTop){
                    $stickBox.addClass('sticky');
                }else{
                    $stickBox.removeClass('sticky');
                }
            });
        });
    </script>
    <style>
        .sticky{
            position: fixed !important;
            top: 10px;
            padding: 0;
        }
        .b-user-media .sticky-box{
            width: 400px;
        }
        .b-user-media-video-top__btn a{
            float: right;
        }
        .b-user-wall{
            width: 590px;
        }
    </style>
    <div class="b-user-media" style="right: 0px; padding-bottom: 100px;">
        <div class="sticky-box">
        @if(count($videoIds) > 0)
        <div class="b-user-media__video">
            <div class="b-user-media-video-top">
                <p class="b-user-media-video-top__title">{{ trans('network.video') }}</p>
                <div class="b-user-media-video-top__btn">
                    <a href="{{URL::to('profile/'.$user->id.'/videos')}}"><input type="button" value="Все" class="btn btn-all"/></a>
                </div>
            </div>
            <ul class="b-user-media-video-gallery">
                @if(count($videoIds) > 0)
                    <div id="video-gallery">
                        @foreach($videoIds as $videoId)
                            <a href="http://www.youtube.com/embed/{{$videoId}}" rel="video">
                                <img src="http://img.youtube.com/vi/{{$videoId}}/0.jpg" style="width:120px; margin: 5px;">
                            </a>
                        @endforeach
                        <script>
                            $('#video-gallery').photobox('a', {thumbs: false, autoplayBtn: false,});
                        </script>
                    </div>
                @else
                    <li class="b-user-media-video-gallery__list" style="width:100%;"><p class="b-user-media-video-top__title">{{ trans('network.no-available-video') }}</p></li>
                @endif
                <div class="clear"></div>
            </ul>
        </div>
        @endif
        @if($photoAlbums->count() > 0)
        <div class="b-user-media__photo">
            <div class="b-user-media-video-top">
                <p class="b-user-media-video-top__title">{{ trans('network.photoalbums') }}</p>
                <div class="b-user-media-video-top__btn">
                    <a href="{{URL::to('profile/'.$user->id.'/photos')}}"><input type="submit" value="Все" class="btn btn-all"/></a>
                </div>
            </div>
            <ul class="b-user-media-video-gallery">
                @if($photoAlbums->count() > 0)
                <div id="photoAlbums">
                    @foreach($photoAlbums as $photoAlbum)
                        <div id='gallery_{{$photoAlbum->id}}' style="float:left;" class="photoAlbum">
                            <a href="{{$photoAlbum->cover}}">
                                <div class="b-user-media-video-gallery__list" style="margin: 4px;width:120px;height:120px;float:left;background:url({{asset($photoAlbum->cover)}}) 50%;background-size: cover;border: 2px solid white;"></div>
                                <img src="{{$photoAlbum->cover}}" style="display: none;" data-pb-captionlink="Обложка фотоальбома '{{$photoAlbum->name}}'[{{URL::to('photoalbum/'.$photoAlbum->id)}}]">
                            </a>
                            <div style="display: none;">
                                @if($photoAlbum->canView())
                                    @foreach($photoAlbum->photos as $photo)
                                        <a href="{{$photo->url}}">
                                            <div class="b-user-media-video-gallery__list" style="margin: 4px;width:120px;height:120px;float:left;background:url({{asset($photo->url)}}) 50%;background-size: cover;border: 2px solid white;"></div>
                                            <img src="{{$photo->url}}" style="display: none;" data-pb-captionlink="{{$photo->name}}[{{URL::to('photos/'.$photo->id)}}]" id="photo_{{$photo->id}}" data-photo-id="{{$photo->id}}" data-can-edit="{{$photo->canEdit()}}" data-rating="{{$photo->rating}}">
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <script>
                            $('#gallery_{{$photoAlbum->id}}').photobox('a', {thumbs: false, albums: true});
                        </script>
                    @endforeach
                </div>
                <script>
                 function photobox(selector){
                     $('#pbCloseBtn').click();
                     $('#pbOverlay').css({ opacity: 1 });
                     setTimeout(function(){
                        $(selector+' a div').click();
                        $('#pbOverlay').removeAttr('style');
                      }, 1000);
                 }
                </script>
                @else
                    <li class="b-user-media-video-gallery__list" style="width:100%;"><p class="b-user-media-video-top__title">{{ trans('network.no-available-photos') }}</p></li>
                @endif
                <div class="clear"></div>
            </ul>
        </div>
        @endif
        @if(isset($musics))
        <div class="b-user-media__music">
            <div class="b-user-media-video-top">
                <p class="b-user-media-video-top__title">{{ trans('network.music') }}</p>
                <div class="b-user-media-video-top__btn">
                    <input type="submit" value="Все" class="btn btn-all"/>
                </div>
            </div>
            <ul class="b-user-media-video-gallery">
                <li class="b-user-media-video-gallery__list" style="width:100%;"><p class="b-user-media-video-top__title">{{ trans('network.no-available-music') }}</p></li>
                <!--li class="b-user-media-video-gallery__list"><a href=""><img src="{{asset('img/19.png')}}" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="{{asset('img/19.png')}}" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="{{asset('img/19.png')}}" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="{{asset('img/19.png')}}" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="{{asset('img/19.png')}}" alt=""/></a></li-->
                <div class="clear"></div>
            </ul>
        </div>
        @endif
        </div>
    </div>
@endif