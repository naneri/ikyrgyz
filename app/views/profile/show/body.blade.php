@if($page == 'newsline' || $page == 'publications' || $page == 'videos')
    @include('topic.build', array('topics' => $items))
@elseif($page == 'subscribtions')
    @include('blog.build', array('blogs' => $items))
@elseif($page == 'friends')
<div class="masonry">
    @foreach($items as $user)
    <div class="item" style="padding: 10px; border: 1px solid #d8d8d8; background: #fff;width:470px;">
        <img src="{{asset(($user->user_profile_avatar) ? $user->user_profile_avatar : asset('img/48.png'))}}" style="float:left;width:60px;height:60px;margin-right: 10px;"/> 
        <div>{{$user->first_name}} {{$user->last_name}}</div>
        <div>{{date_diff(date_create(@$user->birthday), date_create('today'))->y;}}, {{@$user->country}}</div>
        <div>
            [{{HTML::link('profile/'.$user->id, 'Посмотреть профиль')}}]
            [{{HTML::link('messages/new?receiver='.$user->first_name.'+'.$user->last_name, 'Написать сообщение')}}]
        </div>
    </div>
    @endforeach
</div>
@endif
<script>
    $(document).ready(function() {
        var $container = $('.masonry');
        $container.imagesLoaded(function() {
            $container.masonry({
                itemSelector: '.item, .b-user-blog',
                columnWidth: 495,
                gutter: 10,
                stamp: '.b-user-media'
            });
        });
    });
</script>

@if($page == 'newsline')
    <script>
        $(document).ready(function() {
            $('.b-user-media').prependTo(".masonry");
            $('.video-item').each(function(){
                var $video = $(this).find('div.youtube');
                $video = $video.find('object').attr('width', '120').attr('height', '120');
                $(this).html($video);
            });
        });
    </script>
    <div class="b-user-media" style="right: 0px; padding-bottom: 100px;">
        <div class="b-user-media__video">
            <div class="b-user-media-video-top">
                <p class="b-user-media-video-top__title">Видео</p>
                <div class="b-user-media-video-top__btn">
                    <a href="{{URL::to('profile/'.$user->id.'/videos')}}"><input type="button" value="Все" class="btn btn-all"/></a>
                </div>
            </div>
            <ul class="b-user-media-video-gallery">
                @if($videos->count() > 0)
                    @foreach($videos as $video)
                        <li class="b-user-media-video-gallery__list video-item">{{$video->description}}</li>
                    @endforeach
                @else
                    <li class="b-user-media-video-gallery__list" style="width:100%;"><p class="b-user-media-video-top__title">Нет доступных видео</p></li>
                @endif
                <div class="clear"></div>
            </ul>
        </div>
        <div class="b-user-media__photo">
            <div class="b-user-media-video-top">
                <p class="b-user-media-video-top__title">Фотографии</p>
                <div class="b-user-media-video-top__btn">
                    <a href="{{URL::to('profile/'.$user->id.'/photos')}}"><input type="submit" value="Все" class="btn btn-all"/></a>
                </div>
            </div>
            <ul class="b-user-media-video-gallery">
                <li class="b-user-media-video-gallery__list" style="width:100%;"><p class="b-user-media-video-top__title">Нет доступных фотографии</p></li>
                <!--li class="b-user-media-video-gallery__list"><a href=""><img src="{{asset('img/19.png')}}" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="{{asset('img/19.png')}}" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="{{asset('img/19.png')}}" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="{{asset('img/19.png')}}" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="{{asset('img/19.png')}}" alt=""/></a></li-->
                <div class="clear"></div>
            </ul>
        </div>
        <div class="b-user-media__music">
            <div class="b-user-media-video-top">
                <p class="b-user-media-video-top__title">Музыка</p>
                <div class="b-user-media-video-top__btn">
                    <input type="submit" value="Все" class="btn btn-all"/>
                </div>
            </div>
            <ul class="b-user-media-video-gallery">
                <li class="b-user-media-video-gallery__list" style="width:100%;"><p class="b-user-media-video-top__title">Нет доступных музыкальных файлов</p></li>
                <!--li class="b-user-media-video-gallery__list"><a href=""><img src="{{asset('img/19.png')}}" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="{{asset('img/19.png')}}" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="{{asset('img/19.png')}}" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="{{asset('img/19.png')}}" alt=""/></a></li>
                <li class="b-user-media-video-gallery__list"><a href=""><img src="{{asset('img/19.png')}}" alt=""/></a></li-->
                <div class="clear"></div>
            </ul>
        </div>
    </div>
@endif