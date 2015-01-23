@extends('misc.layout')

@section('content')


<div class="container">
{{{$user->email}}} <br>
@if(Auth::id() != $user->id)
	@if($friend_status != True)
		<a href="{{URL::to('people/friendRequest/'. $user->id)}}">Стать друзьями</a>
	@endif
					
    <div class="b-content">
      <div class="b-user-section">
        <div class="b-user-section__image"><a href="#"><img src="img/content/user-profile.png" alt=""/></a><a class="item">Загрузить фото	</a></div>
        <div class="b-user-section__name">
          <p><span class="raiting-text">Рейтинг:</span><span class="raiting-num">+0.00</span></p>
          <p class="user-name">Ярослав Александрович <br/>Маркин</p>
          <p class="date-birth">10 декабря 1990</p>
        </div>
        <div class="b-user-section__widget">
          <ul class="menu dropit">
            <li class="dropit-trigger dropit-open"><a href="#" class="create">Создать</a>
              <ul class="dropit-submenu widget-dropdown">
                <li><a href="">Топик</a></li>
                <li><a href="">Блог</a></li>
                <li><a href="">Черновики</a></li>
                <li><a href="">Ссылка</a></li>
                <li><a href="">Фотосет</a></li>
                <li><a href="">Фото альбом</a></li>
                <li><a href="">Опрос</a></li>
                <li><a href="">Событие</a></li>
              </ul>
            </li>
          </ul>
          <ul class="widgets-top">
            <li><a href="" class="item1"></a></li>
            <li><a href="" class="item2"></a></li>
            <li><a href="" class="item3"></a></li>
            <li><a href="" class="item4"></a></li>
            <li><a href="" class="item5"></a></li>
            <li><a href="" class="item6"></a></li>
            <li><a href="" class="item7"></a></li>
            <div class="clear"></div>
          </ul>
          <ul class="widgets-bot">
            <li><a href="" class="item1">Отправить сообщение</a></li>
            <li><a href="" class="item2">Поиск Друзей</a></li>
            <li><a href="" class="item3">Системные сообщения</a></li>
            <li><a href="" class="item4">Случайный профиль</a></li>
            <div class="clear">				</div>
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
            <li class="last"><a href="#" class="item">	Настройки</a></li>
            <div class="clear"></div>
          </ul>
        </div>
      </div>
      <div class="b-section-wall">
        <div class="b-section-wall__left">
          <div class="b-section-wall__inner">
            <div class="b-section-wall__top"><a href="#"><img src="img/content/user-name.png" alt=""/></a>
              <p class="title">Бурана</p>
              <p class="date">17 Июня 2014 12:53</p>
              <p class="last"> <span class="vis">19 </span><span class="msg">34</span></p>
              <div class="clear"></div>
            </div>
            <div class="b-section-wall__image"><a href="#"><img src="img/content/pic.png" alt=""/></a></div>
            <div class="b-section-wall__bottom"><img src="img/content/user-name.png" alt=""/>
              <p class="title">Красота кыргызского народа</p>
              <p class="topic">31 топик</p>
              <div class="clear"></div>
              <div class="btn-wrapper"><a href="#" class="about">Подробнее</a>
                <ul class="menu dropit share-dropdown"> 
                  <li class="dropit-trigger dropit-open"><a href="#" class="item"></a>
                    <ul class="dropit-submenu">
                      <li><a href="#">sd</a></li>
                      <li><a href="#">sd</a></li>
                      <li><a href="#">dsad</a></li>
                    </ul>
                  </li>
                </ul>
                <input type="submit" class="minus"/>
                <input type="submit" class="plus"/><span>+99</span>
              </div>
            </div>
          </div>
          <div class="b-section-wall__inner">
            <div class="b-section-wall__top"><a href="#"><img src="img/content/user-name.png" alt=""/></a>
              <p class="title">Бурана</p>
              <p class="date">17 Июня 2014 12:53</p>
              <p class="last"> <span class="vis">19 </span><span class="msg">34</span></p>
              <div class="clear"></div>
            </div>
            <div class="b-section-wall__image"><a href="#"><img src="img/content/pic.png" alt=""/></a></div>
            <div class="b-section-wall__bottom"><img src="img/content/user-name.png" alt=""/>
              <p class="title">Красота кыргызского народа</p>
              <p class="topic">31 топик</p>
              <div class="clear"></div>
              <div class="btn-wrapper"><a href="#" class="about">Подробнее</a>
                <ul class="menu dropit share-dropdown"> 
                  <li class="dropit-trigger dropit-open"><a href="#" class="item"></a>
                    <ul class="dropit-submenu share-submenu">
                      <li><a href="#">sd</a></li>
                      <li><a href="#">sd</a></li>
                      <li><a href="#">dsad</a></li>
                    </ul>
                  </li>
                </ul>
                <input type="submit" class="minus"/>
                <input type="submit" class="plus"/><span>+99</span>
              </div>
            </div>
          </div>
        </div>
        <div class="b-section-wall__right">
          <div class="b-section-wall__video">
            <div class="video-title">
              <p class="my-video"><a href="#">Мое видео</a></p>
              <p class="all"><a href="#">Все</a></p>
              <div class="clear"></div>
            </div>
            <ul>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <div class="clear"></div>
            </ul>
          </div>
          <div class="b-section-wall__photo">
            <div class="photo-title">
              <p class="my-photo"><a href="#">Мои фотографии</a></p>
              <p class="all"><a href="#">Все</a></p>
              <div class="clear"></div>
            </div>
            <ul>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <div class="clear"></div>
            </ul>
          </div>
          <div class="b-section-wall__music">
            <div class="music-title">
              <p class="my-music"><a href="#">Моя музыка</a></p>
              <p class="all"><a href="#">Все</a></p>
              <div class="clear"></div>
            </div>
            <ul>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
              <li><a href=""><img src="http://placehold.it/100x100" alt=""/></a></li>
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