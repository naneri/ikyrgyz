@include('scripts.photobox')

@if($page == 'newsline')
    @include('scripts.script-topic', array('page' => '/profile/'.$user->id.'/ajaxTopics/', 'columnN' => false))
    @include('topic.build', array('topics' => $items))
@elseif($page == 'publications' || $page == 'videos')
    @include('scripts.script-topic', array('page' => '/profile/'.$user->id.'/ajaxTopics/', 'columnN' => 2))
    @include('topic.build', array('topics' => $items))
@elseif($page == 'subscribtions')
    @include('blog.build', array('blogs' => $items))
    @include('blog.scripts', array('page' => 'profile/'.$user->id.'/subscribtions'))
@elseif($page == 'friends' || $page == 'mutualFriends' || $page == 'subscribers')
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
@endif

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
@endif