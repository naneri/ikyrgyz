@extends('misc.layout')

@section('content')


<div class="b-content">
{{{$user->email}}} <br>
@if(Auth::id() != $user->id)
	@if($friend_status != True)
		<a href="{{URL::to('people/friendRequest/'. $user->id)}}">Стать друзьями</a>
	@endif
					<div class="b-user-profile">
            <div class="b-user-profile__left"><a href="" class="user-image"><img style="width:40px" src="{{ asset($user->description->user_profile_avatar) }}" alt=""/></a>
              <p class="user-link-photo"><a href="#">Загрузить фото</a></p>
            </div>
            <div class="b-user-profile__middle">
              <p class="user-raiting">Рейтинг<span class="num">+0.00</span></p>
              <p class="user-name">Ярослав Александрович </br>Маркин</p>
              <p class="user-date">10 декабря 1990</p>
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
                <li class="b-user-profile-buttons__list"><a href="#">Отравить сообщение<span class="msg-image"></span></a></li>
                <li class="b-user-profile-buttons__list"><a href="#">Поиск друзей<span class="search-image"></span></a></li>
                <li class="b-user-profile-buttons__list"><a href="#">Системные сообщения<span class="system-image"></span></a></li>
                <li class="b-user-profile-buttons__list"><a href="#">Случайный профиль<span class="random-image"></span></a></li>
              </ul>
            </div>
            <div class="clear"></div>
          </div>
    <div class="b-user-navigation">
            <ul class="b-user-navigation-list">
              <li class="b-user-navigation-list__list"><a href="#">Лента</a></li>
              <li class="b-user-navigation-list__list"><a href="#">Публикации</a><span>999</span></li>
              <li class="b-user-navigation-list__list"><a href="#">Друзья</a><span>999</span></li>
              <li class="b-user-navigation-list__list"><a href="#">Избранное</a></li><a href="#" class="b-user-navigation-list__setting">Настройки</a>
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
              <div class="b-user-media__music">
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
            </div>
            <div class="clear"></div>
          </div>
  </div>
  
				@else
					<b>Это вы</b>	
				@endif
		
	</div>
@stop

<!-- 

  
    <div class="b-content">
        <div class="b-user-section">
          <div class="b-user-section__image"><a href="#"><img src="{{ asset('img/content/pic.png') }}" alt=""/></a><a class="item">Загрузить фото</a></div>
          <div class="b-user-section__name">
            <p class="raiting-text">Рейтинг:</p>
            <p class="raiting-num">+0.00</p>
            <p class="user-name">Ярослав Александрович <br/>Маркин</p>
            <p class="date-birth">10 декабря 1990</p>
          </div>
          <div class="b-user-section__widget">
            <ul class="menu dropit">
              <li class="dropit-trigger dropit-open"><a href="#" class="create">Создать</a></li>
            </ul>
            <ul class="widgets-top">
              <li><a href="#" class="item1"></a></li>
              <li><a href="#" class="item2"></a></li>
              <li><a href="#" class="item3"></a></li>
              <li><a href="#" class="item4"></a></li>
              <li><a href="#" class="item5"></a></li>
              <li><a href="#" class="item6"></a></li>
              <li><a href="#" class="item7"></a></li>
              <div class="clear"></div>
            </ul>
            <ul class="widgets-bot">
              <li><a href="#" class="item1">Отправить сообщение</a></li>
              <li><a href="#" class="item2">Поиск Друзей</a></li>
              <li><a href="#" class="item3">Системные сообщения</a></li>
              <li><a href="#" class="item4"> <span>Случайный профиль</span></a></li>
              <div class="clear"></div>
            </ul>
          </div>
          <div class="clear"></div>
        </div>
        <div class="b-section-nav">
          <div class="b-section__inner">
            <ul>
              <li><a href="#">Лента</a></li>
              <li><a href="#">Публикации</a><span>999</span></li>
              <li><a href="#">Друзья</a><span>999</span></li>
              <li><a href="#">Избранное</a><span>999</span></li>
              <li class="last"><a href="#" class="item">Настройки</a></li>
              <div class="clear"></div>
            </ul>
          </div>
        </div>
       <div class="b-section-wall">
          <div class="b-section-wall__left">
            <div class="b-section-wall__inner">
              <div class="b-section-wall__top"><a href="#"><img src="{{ asset('img/content/user-name.png') }}" alt=""/></a>
                <p class="title">Бурана</p>
                <p class="date">17 Июня 2014 12:53</p>
                <p class="last"> <span class="vis">19 </span><span class="msg">34</span></p>
                <div class="clear"></div>
              </div>
              <div class="b-section-wall__image"><a href="#"><img src="{{ asset('img/content/pic.png') }}" alt=""/></a></div>
              <div class="b-section-wall__bottom"><img src="{{ asset('img/content/user-name.png') }}" alt=""/>
                <p class="title">Красота кыргызского народа</p>
                <p class="topic">31 топик</p>
                <div class="clear"></div>
                <div class="btn-wrapper"><a href="#" class="about">Подробнее</a>
                  <ul class="share-dropdown"> 
                    <li><a href="#" class="share"></a>
                      <ul class="dropit-submenu">
                        <li><a href="#"> <span class="soc item1"></span><span class="title">Facebook</span></a></li>
                        <li><a href="#"> <span class="soc item2"></span><span class="title">Facebook</span></a></li>
                        <li><a href="#"> <span class="soc item3"></span><span class="title">Facebook</span></a></li>
                        <li><a href="#"> <span class="soc item4"></span><span class="title">Facebook</span></a></li>
                        <li><a href="#"> <span class="soc item5"></span><span class="title">Facebook</span></a></li>
                      </ul>
                    </li>
                  </ul>
                  <input type="submit" class="minus"/>
                  <input type="submit" class="plus"/><span class="like">+99</span>
                </div>
              </div>
            </div>
            <div class="b-section-wall__inner">
              <div class="b-section-wall__top"><a href="#"><img src="{{ asset('img/content/user-name.png') }}" alt=""/></a>
                <p class="title">Бурана</p>
                <p class="date">17 Июня 2014 12:53</p>
                <p class="last"> <span class="vis">19 </span><span class="msg">34</span></p>
                <div class="clear"></div>
              </div>
              <div class="b-section-wall__image"><a href="#"><img src="{{ asset('img/content/pic.png') }}" alt=""/></a></div>
              <div class="b-section-wall__bottom"><img src="{{ asset('img/content/user-name.png') }}" alt=""/>
                <p class="title">Красота кыргызского народа</p>
                <p class="topic">31 топик</p>
                <div class="clear"></div>
                <div class="btn-wrapper"><a href="#" class="about">Подробнее</a>
                  <ul class="share-dropdown"> 
                    <li><a href="#" class="share"></a>
                      <ul class="dropit-submenu">
                        <li><a href="#"> <span class="soc item1"></span><span class="title">Facebook</span></a></li>
                        <li><a href="#"> <span class="soc item2"></span><span class="title">Facebook</span></a></li>
                        <li><a href="#"> <span class="soc item3"></span><span class="title">Facebook</span></a></li>
                        <li><a href="#"> <span class="soc item4"></span><span class="title">Facebook</span></a></li>
                        <li><a href="#"> <span class="soc item5"></span><span class="title">Facebook</span></a></li>
                      </ul>
                    </li>
                  </ul>
                  <input type="submit" class="minus"/>
                  <input type="submit" class="plus"/><span class="like">+99</span>
                </div>
              </div>
            </div>
          </div>
          <div class="b-section-wall__right">
            <div class="b-section-wall__video">
              <div class="video-title">
                <p class="my-video"><a href="#">Мое видео</a></p><a href="#" class="all">Все</a>
                <div class="clear"></div>
              </div>
              <ul>
                <li><a href=""><img src="{{ asset('img/content/image.png') }}" alt=""/></a></li>
                <li><a href=""><img src="{{ asset('img/content/image.png') }}" alt=""/></a></li>
                <li><a href=""><img src="{{ asset('img/content/image.png') }}" alt=""/></a></li>
                <li><a href=""><img src="{{ asset('img/content/image.png') }}" alt=""/></a></li>
                <li><a href=""><img src="{{ asset('img/content/image.png') }}" alt=""/></a></li>
                <li><a href=""><img src="{{ asset('img/content/image.png') }}" alt=""/></a></li>
                <div class="clear"></div>
              </ul>
            </div>
            <div class="b-section-wall__photo">
              <div class="photo-title">
                <p class="my-photo"><a href="#">Мои фотографии</a></p><a href="#" class="all">Все</a>
                <div class="clear"></div>
              </div>
              <ul>
                <li><a href=""><img src="{{ asset('img/content/image.png') }}" alt=""/></a></li>
                <li><a href=""><img src="{{ asset('img/content/image.png') }}" alt=""/></a></li>
                <li><a href=""><img src="{{ asset('img/content/image.png') }}" alt=""/></a></li>
                <li><a href=""><img src="{{ asset('img/content/image.png') }}" alt=""/></a></li>
                <li><a href=""><img src="{{ asset('img/content/image.png') }}" alt=""/></a></li>
                <li><a href=""><img src="{{ asset('img/content/image.png') }}" alt=""/></a></li>
                <div class="clear"></div>
              </ul>
            </div>
            <div class="b-section-wall__music">
              <div class="music-title">
                <p class="my-music"><a href="#">Моя музыка</a></p><a href="" class="all">Все</a>
                <div class="clear"></div>
              </div>
              <ul>
                <li><a href=""><img src="{{ asset('img/content/image.png') }}" alt=""/></a></li>
                <li><a href=""><img src="{{ asset('img/content/image.png') }}" alt=""/></a></li>
                <li><a href=""><img src="{{ asset('img/content/image.png') }}" alt=""/></a></li>
                <li><a href=""><img src="{{ asset('img/content/image.png') }}" alt=""/></a></li>
                <li><a href=""><img src="{{ asset('img/content/image.png') }}" alt=""/></a></li>
                <li><a href=""><img src="{{ asset('img/content/image.png') }}" alt=""/></a></li>
                <div class="clear"></div>
              </ul>
            </div>
          </div>
          <div class="clear"></div>
        </div>
      </div>
    </div>
-->