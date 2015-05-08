<div class="b-search">
	<div class="b-search__item">
		<input type="text" value="Поиск">
		<input type="submit">
	</div>
</div>
<div class="b-topic-navigation menu">
	<div class="b-topic-navigation__inner ">
		<div class="b-topic-navigation__left">
			<div class="b-topic-navigation-menu">
				<div class="b-topic-navigation-menu__list">
					<a href="#" class="arrow">Я-КЫРГЫЗ</a>
					<dl class="dropdown-list">
						<dt>Мой профиль</dt>
							<dd><a href="#">{{ trans('network.publications') }}</a> <span class="raiting">143</span></dd>
							<dd><a href="{{ URL::to('messages/inbox/all') }}">{{ trans('network.personal-messages') }}</a><span class="raiting">143</span></dd>
							<dd><a href="{{ URL::to('profile/friends') }}">{{ trans('network.friends') }}</a><span class="raiting">143</span></dd>
							<dd><a href="">Подписки</a><span class="raiting">143</span></dd>
							<dd><a href="#">{{ trans('network.favorite') }}</a><span class="raiting">143</span></dd>
						<dt>Энкиклопедия</dt>
							<dd><a href="{{ URL::to('custom/history') }}">{{ trans('network.history') }}</a></dd>
							<dd><a href="{{ URL::to('custom/customs') }}">{{ trans('network.customs') }}</a></dd>
							<dd><a href="{{ URL::to('custom/culture') }}">{{ trans('network.culture') }} </a></dd>
						<dt>Помощь</dt>
							<dd><a href="">Сообщить о проблеме</a></dd>
							<dd><a href="">Истоиря действии</a></dd>	
						<dt>Настройки</dt>
							<dd>Выберите язык
							<a href="">
								<img src="{{ asset('img/103.png') }}" alt=""/>
							</a>
							<a href="">
								<img src="{{ asset('img/104.png') }}" alt=""/>
							</a>
							
							</dd>
						<dt><a href="{{ URL::to('logout') }}">{{ trans('network.exit') }}</a>
						</dt>	
					</dl>

				</div>
			</div>
			<div class="b-topic-navigation-sort">
				<ul>
					<li class="b-topic-navigation-sort__item">
						<a href="#"></a>
						
					</li>
					<li class="b-topic-navigation-sort__item">
						<a href="#"></a>
					</li>
					<li class="b-topic-navigation-sort__item">
						<a href="#"></a>
					</li>
				
				</ul>
				
				<a href="#"></a>
				<a href="#"></a>
				<div class="clear"></div>
			</div>
			<div class="b-topic-navigation-category">
				<ul>
					<li class="b-topic-navigation-category__item item1">
						<a href="#"></a>
					</li>
					<li class="b-topic-navigation-category__item item2">
						<a href="#"></a>
					</li>
					<li class="b-topic-navigation-category__item item3">
						<a href="#"></a>
					</li>
					<li class="b-topic-navigation-category__item item4">
						<a href="#"></a>
					</li>
					<li class="b-topic-navigation-category__item item5">
						<a href="#"></a>
					</li>
					<li class="b-topic-navigation-category__item item6">
						<a href="#"></a>
					</li>
				</ul>
				
				<div class="clear"></div>
			</div>
			<div class="b-topic-navigation-choose">
				<div class="b-topic-navigation-choose__list">
				<a href="" class="b-topic-navigation-choose__item"></a>
				<ul class="dropdown-list">
					<li class="dropdown-list__item dropdown-list__item_title">
					Сортировать топики по</li>
					<li class="dropdown-list__item">
					
						<div class="choose-list">
    					<label class="choose-list">
    					<img src="{{ asset('img/87.png') }}" alt="">
    					<span>Видео</span>
       					 <input type="checkbox" class="bigcheck bigcheck1 " name="cheese" value="yes" checked="checked"/>
        				<span class="choose-list-target"></span>
    					</label>
						</div>
					</li>
					<li class="dropdown-list__item">
						<div class="choose-list">
    					<label class="choose-list">
    					<img src="{{ asset('img/88.png') }}" alt="">
    					<span>Видео</span>
       					 <input type="checkbox" class="bigcheck bigcheck2" name="cheese" value="yes" checked="checked"/>
        				<span class="choose-list-target"></span>
    					</label>
						</div>
					</li>
					<li class="dropdown-list__item">
						<div class="choose-list">
						
    					<label class="choose-list">
    					<img src="{{ asset('img/89.png') }}" alt="">
    					<span>Видео</span>
						
       					 <input type="checkbox" class="bigcheck bigcheck3" name="cheese" value="yes"/ checked="checked" >
        				<span class="choose-list-target"></span>
    					</label>
						</div>
					</li>
					<li class="dropdown-list__item">
						<div class="choose-list">
						
    					<label class="choose-list">
    					<img src="{{ asset('img/90.png') }}" alt="">
    					<span>Видео</span>
						
       					 <input type="checkbox" class="bigcheck bigcheck4" name="cheese" value="yes"/ checked="checked">
        				<span class="choose-list-target"></span>
    					</label>
						</div>
					</li>
					<li class="dropdown-list__item">
						<div class="choose-list">
						
    					<label class="choose-list">
    					<img src="{{ asset('img/91.png') }}" alt="">
    					<span>Видео</span>
						
       					 <input type="checkbox" class="bigcheck bigcheck5" name="cheese" value="yes"/ checked="checked">
        				<span class="choose-list-target"></span>
    					</label>
						</div>
					</li>
					<li class="dropdown-list__item">
						<div class="choose-list">
						
    					<label class="choose-list">
    					<img src="{{ asset('img/92.png') }}" alt="">
    					<span>Видео</span>
						
       					 <input type="checkbox" class="bigcheck bigcheck6" name="cheese" value="yes"/ checked="checked">
        				<span class="choose-list-target"></span>
    					</label>
						</div>
					</li>
					
				</ul>
			</div>
			</div>
			<div class="clear"></div>
		</div>	
		<div class="b-topic-navigation__right">
    
			 <div class="cube"><a href=""></a></div>
				<div class="b-topic-navigation-line">

					<a href="#" class="b-topic-navigation-line__item"></a>
					<ul class="dropdown-list">
						<li><a href=""><img src="{{ asset('img/93.png') }}" alt=""><span>Имя Фамилия Отчество</span></a></li>
						<li><a href=""><img src="{{ asset('img/93.png') }}" alt=""><span>Имя Фамилия Отчество</span></a></li>
						<li><a href=""><img src="{{ asset('img/93.png') }}" alt=""><span>Имя Фамилия Отчество</span></a></li>
						<li><a href=""><img src="{{ asset('img/93.png') }}" alt=""><span>Имя Фамилия Отчество</span></a></li>
						<li><a href=""><img src="{{ asset('img/93.png') }}" alt=""><span>Имя Фамилия Отчество</span></a></li>
						<li><a href=""><img src="{{ asset('img/93.png') }}" alt=""><span>Имя Фамилия Отчество</span></a></li>
						<li><a href=""><img src="{{ asset('img/93.png') }}" alt=""><span>Имя Фамилия Отчество</span></a></li>
						<li><a href=""><img src="{{ asset('img/93.png') }}" alt=""><span>Имя Фамилия Отчество</span></a></li>
						<li><a href=""><img src="{{ asset('img/93.png') }}" alt=""><span>Имя Фамилия Отчество</span></a></li>
					</ul>
				</div>
				<div class="b-topic-navigation-format">
					<a href="#" class="b-topic-navigation-format__item"></a>
					<ul class="dropdown-list">
						<li class="format-list"><a href="javascript: makeColumnN('1')"></a></li>
						<li class="format-list"><a href="javascript: makeColumnN('2')"></a></li>
						<li class="format-list"><a href="javascript: makeColumnN('3')"></a></li>
					</ul>
				</div>
		</div>
		<div class="clear"></div>
		<!-- <div class="b-topic-navigation__create">
			<ul class="b-topic-navigation-list">
				<li>
					<a href="#" class="b-topic-navigation__item">{{ trans('network.create') }}</a>
					<ul class="b-topic-navigation-create b-topic-navigation-create-dropdown" style="height: 125px !important">
						<li class="b-topic-navigation-create__list">
							<a href="{{ URL::to('topic/create') }}">{{ trans('network.topic') }}</a>
						</li>
						<li class="b-topic-navigation-create__list">
							<a href="{{ URL::to('blog/create') }}">{{ trans('network.blog') }}</a>
						</li>
						<li class="b-topic-navigation-create__list" style="display: none;">
							<a href="#">{{ trans('network.drafts') }}</a>
						</li>
						<li class="b-topic-navigation-create__list" style="display: none;">
							<a href="#">{{ trans('network.link') }}</a>
						</li>
						<li class="b-topic-navigation-create__list">
							<a href="{{URL::to('photoalbum/create')}}">{{trans('network.photoalbum')}}</a>
						</li> -->
						<!--
						<li class="b-topic-navigation-create__list">
							<a href="#">Опрос</a>
						</li>
						<li class="b-topic-navigation-create__list">
							<a href="#">Событие</a>
						</li>
						-->
		<!-- 			</ul>
				</li>
			</ul>
		</div>
		<div class="b-topic-navigation__middle">
			<ul>
				<li class="b-topic-navigation-item__item"><a href="{{URL::to('main/index/new')}}"><img src="{{ asset('img/33.png') }}" alt=""/><span style="opacity:0">19</span></a></li>
				<li class="b-topic-navigation-item__item"><a href="{{URL::to('blog/all')}}"><img src="{{ asset('img/41.png') }}" alt=""/><span style="opacity:0">19</span></a></li>
				<li class="b-topic-navigation-item__item"><a href="{{URL::to('main/index/top')}}"><img src="{{ asset('img/34.png') }}" alt=""/><span style="opacity:0">19</span></a></li>
				
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
				
			</ul>
		</div>
		<div class="b-topic-navigation__right">
			<ul class="b-topic-navigation-format">
				<li class="b-topic-navigation-format__list">
					<div class="b-topic-navigation-format__wrapper">
					<a href="javascript: void(0)" class="format-icon" style="display: block; width: 42px; padding: 5px 0px 0px 18px;"><img src="{{ asset('img/42.png') }}" alt=""/></a>
					<ul class="b-topic-navigation-format-dropdown">
						<li><a href="javascript: makeColumnN('1')"><img src="{{ asset('img/44.png') }}" alt=""/></a></li>
						<li><a href="javascript: makeColumnN('2')"><img src="{{ asset('img/45.png') }}" alt=""/></a></li>
						<li><a href="javascript: makeColumnN('3')"><img src="{{ asset('img/46.png') }}" alt=""/></a></li>
					</ul>
					 </div>
				</li> -->
				<!-- <li class="b-topic-navigation-format__list"> --><!-- <a href="" class="format-icon"><img src="{{ asset('img/37.png') }}" alt=""/><span style="opacity:0">11</span>  </a>-->
				<!-- 	<ul style="opacity:0" class="b-topic-navigation-online-dropdown">
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
</div> -->



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
	</div>
</div>