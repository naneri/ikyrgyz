<div class="b-topic-navigation">
            <div class="b-topic-navigation__inner">
              <div class="b-topic-navigation__create">
                <ul class="b-topic-navigation-list">
                  <li><a href="#" class="b-topic-navigation__item">Создать</a>
                    <ul class="b-topic-navigation-create b-topic-navigation-create-dropdown" style="height: 160px !important">
                      <li class="b-topic-navigation-create__list">
                      	<a href="{{ URL::to('topic/create') }}">Топик</a>
                      </li>
                      <li class="b-topic-navigation-create__list">
                      	<a href="{{ URL::to('blog/create') }}">Блог</a>
                      </li>
                      <li class="b-topic-navigation-create__list">
                      	<a href="#">Черновики</a>
                      </li>
                      <li class="b-topic-navigation-create__list">
                      	<a href="#">Ссылка</a>
                      </li>
                      <!--
                      <li class="b-topic-navigation-create__list">
                      	<a href="#">Фото альбом</a>
                      </li>
                      <li class="b-topic-navigation-create__list">
                      	<a href="#">Опрос</a>
                      </li>
                      <li class="b-topic-navigation-create__list">
                      	<a href="#">Событие</a>
                      </li>
                      -->
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="b-topic-navigation__middle">
                <ul>
                    <li class="b-topic-navigation-item__item"><a href="{{URL::to('main/index/new')}}"><img src="{{ asset('img/33.png') }}" alt=""/><span style="opacity:0">19</span></a></li>
                  <li class="b-topic-navigation-item__item"><img src="{{ asset('img/41.png') }}" alt=""/><span style="opacity:0">19</span></li>
                  <li class="b-topic-navigation-item__item"><a href="{{URL::to('main/index/top')}}"><img src="{{ asset('img/34.png') }}" alt=""/><span style="opacity:0">19</span></a></li>
                  <!--
                  <li class="b-topic-navigation-item__item"><a href="" class="icon-image"><img src="{{ asset('img/35.png') }}" alt=""/></a>
                    <ul class="b-topic-navigation-icons-list b-topic-navigation-icons-dropdown">
                      <li class="b-topic-navigation-icons-list__list b-topic-navigation-icons-list__list-padding"><a href="">Видео</a></li>
                      <li class="b-topic-navigation-icons-list__list"><a href="">Фотоальбомы</a></li>
                      <li class="b-topic-navigation-icons-list__list"><a href="">Музыка</a></li>
                      <li class="b-topic-navigation-icons-list__list"><a href="">Ссылки</a></li>
                      <li class="b-topic-navigation-icons-list__list"><a href="">Опросы</a></li>
                      <li class="b-topic-navigation-icons-list__list"><a href="">События</a></li>
                    </ul>
                  </li>
                  -->
                </ul>
              </div>
              <div class="b-topic-navigation__right">
                <ul class="b-topic-navigation-format">
           <!--       <li class="b-topic-navigation-format__list"><a href="#" class="format-icon"><img src="{{ asset('img/42.png') }}" alt=""/></a>
                    <ul class="b-topic-navigation-format-dropdown">
                      <li><a href=""><img src="{{ asset('img/44.png') }}" alt=""/></a></li>
                      <li><a href=""><img src="{{ asset('img/45.png') }}" alt=""/></a></li>
                      <li><a href=""><img src="{{ asset('img/46.png') }}" alt=""/></a></li>
                    </ul>
                  </li> -->

                  <li class="b-topic-navigation-format__list"><!-- <a href="" class="format-icon"><img src="{{ asset('img/37.png') }}" alt=""/><span style="opacity:0">11</span>  --></a>
                    <ul style="opacity:0" class="b-topic-navigation-online-dropdown">
                      <li>
                        <a href="">
                          <span>Фамилия Имя Отчество</span>
                          <img src="{{ asset('img/47.png') }}" alt=""/>
                        </a>
                        <a href="">
                          <span>Фамилия Имя Отчество</span>
                          <img src="{{ asset('img/47.png') }}" alt=""/>
                        </a>
                        <a href="">
                          <span>Фамилия Имя Отчество</span>
                          <img src="{{ asset('img/47.png') }}" alt=""/>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="b-topic-navigation-format__list">
                    <div class="buttons-wrapper">
                      <form id="" method="" action="">
                        <input type="text" class="format-type btn"/>
                        <input type="submit" class="format-submit"/>
                      </form>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="clear"></div>
            </div>
          </div>



    <!-- <div class="b-content-nav">
	<div class="b-content-nav__inner">
	  <div class="b-content-nav__create">
	    <ul class="create-dropdown"> 
	      <li><a href="#" class="create">Создать</a>
	        <ul class="dropit-submenu create-submenu">
	          <li><a href="{{ URL::to('topic/create') }}"> <span class="create item1"></span><span class="title">Топик</span></a></li>
	          <li><a href="{{ URL::to('blog/create') }}"> <span class="create item2"></span><span class="title">Блог</span></a></li>
	          <li><a href="#"> <span class="create item3"></span><span class="title">Черновики</span></a></li>
	          <li><a href="#"> <span class="create item4"></span><span class="title">Ссылка</span></a></li>
	          <li><a href="#"> <span class="create item5"></span><span class="title">Фото альбом</span></a></li>
	          <li><a href="#"> <span class="create item6"></span><span class="title">Опрос</span></a></li>
	          <li><a href="#"> <span class="create item7"></span><span class="title">Событие</span></a></li>
	        </ul>
	      </li>
	    </ul>
	  </div>
	  <div class="b-content-nav__social">
	    <div class="b-content-nav-social">
	      <div class="b-content-nav-social__item">
	      	<a href="#" class="item1"></a><span class="item1">19</span>
	      	<a href="{{ URL::to('blog/all') }}" class="item2"></a><span class="item2">19</span>
	      	<a href="#" class="item3"></a></div>
	    </div>
	  </div>
	  <div class="b-content-nav__media">
	    <ul class="media-dropdown"> 
	      <li><a href="#" class="media"> </a>
	        <ul class="dropit-submenu media-submenu">
	          <li><a href="#"> <span class="media item1"></span><span class="title">Видео</span></a></li>
	          <li><a href="#"> <span class="media item2"></span><span class="title">Фото альбомы</span></a></li>
	          <li><a href="#"> <span class="media item3"></span><span class="title">Музыка</span></a></li>
	          <li><a href="#"> <span class="media item4"></span><span class="title">Ссылки</span></a></li>
	          <li><a href="#"> <span class="media item5"></span><span class="title">Опросы</span></a></li>
	          <li><a href="#"> <span class="media item6"></span><span class="title">События</span></a></li>
	        </ul>
	      </li>
	    </ul>
	  </div>
	  <div class="b-content-nav__icon">
	    <ul class="icon-dropdown"> 
	      <li><a href="#" class="item"> </a>
	        <ul class="dropit-submenu icon-submenu">
	          <li><a href="#" class="icon item1"></a></li>
	          <li><a href="#" class="icon item2"></a></li>
	          <li><a href="#" class="icon item3"> </a></li>
	        </ul>
	      </li>
	    </ul>
	  </div>
	  <div class="b-content-nav__friends">
	    <ul class="friends-dropdown"> 
	      <li><a href="#" class="item"></a>
	        <ul class="dropit-submenu friends-submenu">
	          <li><a href="#"> <img src="img/content/profile.png" alt=""/><span class="name">Фамилия Имя Отчество</span></a></li>
	          <li><a href="#"> <img src="img/content/profile.png" alt=""/><span class="name">Фамилия Имя Отчество</span></a></li>
	          <li><a href="#"> <img src="img/content/profile.png" alt=""/><span class="name">Фамилия Имя Отчество</span></a></li>
	          <li><a href="#"> <img src="img/content/profile.png" alt=""/><span class="name">Фамилия Имя Отчество</span></a></li>
	          <li><a href="#"> <img src="img/content/profile.png" alt=""/><span class="name">Фамилия Имя Отчество</span></a></li>
	          <li><a href="#"> <img src="img/content/profile.png" alt=""/><span class="name">Фамилия Имя Отчество						</span></a></li>
	        </ul>
	      </li>
	    </ul>
	  </div>
	  <div class="b-content-nav__search-btn">
	    <div class="b-content-nav-search">
	      <form id="" method="" action="">
	        <input type="text" class="item1"/>
	        <input type="submit" class="item2"/>
	      </form>
	    </div>
	  </div>
	</div>
</div>
-->
	<!--	<ul style="margin:30px; padding:30px; list-style-type: none;">
			<li>Create</li>
			<li><a href="{{URL::to('topic/create')}}">Topic</a></li>
			<li><a href="{{URL::to('blog/create')}}">Blog</a></li>
			<li><a href="{{URL::to('blog/all')}}">Blogs</a></li>
		</ul> -->