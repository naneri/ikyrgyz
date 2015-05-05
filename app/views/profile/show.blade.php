@extends('misc.layout')

@section('content')


<div class="b-content">


@if(Auth::id() != $user->id)
	@if($friend_status != True)
		
	@endif
					<div class="b-user-profile">
          @if(isset($user->description->user_profile_avatar))
            <div class="b-user-profile__left"><a href="" class="user-image"><img  src="{{ asset($user->description->user_profile_avatar) }}" alt=""/></a>
              <p class="user-link-photo"><a href="#">{{ trans('network.upload-photo') }}</a></p>
            </div>
          @else
            <div class="b-user-profile__left"><a href="" class="user-image"><img  src="{{ asset('images/content/12.png') }}" alt=""/></a>
              <p class="user-link-photo"><a href="#">{{ trans('network.upload-photo') }}</a></p>
            </div>
          @endif
            
            <div class="b-user-profile__middle">
              <p class="user-raiting">{{ trans('network.rating') }} <span class="num">{{number_format($user->rating, 2)}}</span></p>
              <p class="user-name">{{$user->getNames()}}</p>
              <p class="user-date">{{$user->description->birthday}}</p>
            </div>
            <div class="b-user-profile__right">
              <div class="b-user-profile-link"><a href="#" class="b-user-profile-link__create">Создать</a></div>
              <ul class="b-user-profile-links">
                <li class="b-user-profile-links__list"><a href="#"></a></li>
                <li class="b-user-profile-links__list"><a href="#"></a></li>
                <li class="b-user-profile-links__list"><a href="#"></a></li>
                <li class="b-user-profile-links__list"><a href="#"></a></li>
                <li class="b-user-profile-links__list"><a href="#"></a></li>
                <li class="b-user-profile-links__list"><a href="#"></a></li>
                <li class="b-user-profile-links__list"><a href="#"></a></li>
                <div class="clear"></div>
              </ul>
              <ul class="b-user-profile-buttons">
                <li class="b-user-profile-buttons__list"><a href="#">{{ trans('network.send-message') }}<span class="msg-image"></span></a></li>
                <li class="b-user-profile-buttons__list"><a href="#">{{ trans('network.search-friends') }}<span class="search-image"></span></a></li>
                <li class="b-user-profile-buttons__list"><a href="#">{{ trans('network.system-messages') }}<span class="system-image"></span></a></li>
                <li class="b-user-profile-buttons__list"><a href="{{URL::to('profile/random')}}">{{ trans('network.random-profile') }}<span class="random-image"></span></a></li>
              </ul>
            </div>
            <div class="clear"></div>
          </div>
    <div class="b-user-navigation">
            <ul class="b-user-navigation-list">
              <li class="b-user-navigation-list__list"><a href="#">{{ trans('network.timeline') }}</a></li>
              <li class="b-user-navigation-list__list"><a href="#">{{ trans('network.publications') }}</a><span>999</span></li>
              <li class="b-user-navigation-list__list"><a href="#">{{ trans('network.friends') }}</a><span>999</span></li>
              <li class="b-user-navigation-list__list"><a href="#">{{ trans('network.favorite') }}</a></li><a href="#" class="b-user-navigation-list__setting">{{ trans('network.settings') }}</a>
              <div class="clear"></div>
            </ul>
          </div>
          <div class="b-section-wrapper">
            <div class="b-user-wall">
              <div class="b-user-wall__inner">
                <div class="b-user-wall-header">
                  <div class="b-user-wall-header__image"><a href=""><img src="img/48.png" alt=""/></a></div>
                  <p class="b-user-wall-header__title">Бурана</p>
                  <p class="b-user-wall-header__date">17 июня 2014, 12:53
                    <div class="clear"></div>
                  </p>
                  <p class="b-user-wall-header__vision"><img src="img/22.png" alt=""/><span>19</span><img src="img/23.png" alt=""/><span>34</span></p>
                </div>
                <div class="b-user-wall-image"><a href=""><img src="img/21.png" alt=""/></a></div>
                <div class="b-user-wall-footer">
                  <div class="b-user-wall-footer__image"><a href=""><img src="img/40.png" alt=""/></a></div>
                  <p class="b-user-wall-footer__title">Красота Кыргызского народа</p>
                  <p class="b-user-wall-footer__number">31 топик
                    <div class="clear"></div>
                  </p>
                  <div class="b-user-wall-footer__btn"><a href="" class="about-btn btn">Подробнее</a>
                    <ul class="b-user-wall-footer-list">
                      <li><a href="" class="share-btn btn">Поделиться</a>
                        <ul class="b-user-wall-footer-dropdown">
                          <li><a href="">Facebook</a></li>
                          <li><a href="">Google+</a></li>
                          <li><a href="">Twitter</a></li>
                          <li><a href="">Мой мир</a></li>
                          <li><a href="">В контакте</a></li>
                        </ul>
                      </li>
                    </ul>
                    <input type="submit" class="btn btn-minus"/>
                    <input type="submit" class="btn btn-plus"/><span class="likes">+99</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="b-user-media">
              <div class="b-user-media__video">
                <div class="b-user-media-video-top">
                  <p class="b-user-media-video-top__title">{{ trans('network.my-video') }}</p>
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
                  <p class="b-user-media-video-top__title">{{ trans('network.my-video') }}</p>
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
                  <p class="b-user-media-video-top__title">{{ trans('network.my-video') }}</p>
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
            <div class="clear"></div>
          </div>
  </div>
  
				@else
					<b>Это вы</b>	
				@endif
		
	</div>
@stop

