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
						<dt><a href="{{URL::to('profile')}}">Мой профиль</a></dt>
							<dd><a href="#">{{ trans('network.publications') }}</a> <span class="raiting">{{$topic_number}}</span></dd>
							<dd><a href="{{ URL::to('messages/inbox/all') }}">{{ trans('network.personal-messages') }}</a><span class="raiting">{{count($new_messages)}}</span></dd>
							<dd><a href="{{ URL::to('profile/friends') }}">{{ trans('network.friends') }}</a><span class="raiting">{{$friend_number}}</span></dd>
							<dd><a href="{{URL::to('profile/subscriptions')}}">Подписки</a><span class="raiting">143</span></dd>
							<dd><a href="#">{{ trans('network.favorite') }}</a><span class="raiting">143</span></dd>
						<dt><a href="">Энкиклопедия</a></dt>
							<dd><a href="{{ URL::to('custom/history') }}">{{ trans('network.history') }}</a></dd>
							<dd><a href="{{ URL::to('custom/customs') }}">{{ trans('network.customs') }}</a></dd>
							<dd><a href="{{ URL::to('custom/culture') }}">{{ trans('network.culture') }} </a></dd>
						<dt>Помощь</dt>
							<dd><a href="">Сообщить о проблеме</a></dd>
							<dd><a href="">Истоиря действии</a></dd>	
						<dt>Настройки</dt>
							<dd>Выберите язык
							<a href="{{ URL::to('locale/ru') }}">
								<img src="{{ asset('img/103.png') }}" alt=""/>
							</a>
							<a href="{{ URL::to('locale/en') }}">
								<img src="{{ asset('img/104.png') }}" alt=""/>
							</a>
							
							</dd>
						<dt><a href="{{URL::to('logout')}}">Выход</a></dt>	
					</dl>

				</div>
			</div>
			<div class="b-topic-navigation-sort">
				<ul>
					<li class="b-topic-navigation-sort__item">
						<a href="{{URL::to('main/index')}}"></a>
						
					</li>
					<li class="b-topic-navigation-sort__item">
						<a href="{{URL::to('main/index/top')}}"></a>
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
    					<span>Фото</span>
       					 <input type="checkbox" class="bigcheck bigcheck2" name="cheese" value="yes" checked="checked"/>
        				<span class="choose-list-target"></span>
    					</label>
						</div>
					</li>
					<li class="dropdown-list__item">
						<div class="choose-list">
						
    					<label class="choose-list">
    					<img src="{{ asset('img/89.png') }}" alt="">
    					<span>Аудио</span>
						
       					 <input type="checkbox" class="bigcheck bigcheck3" name="cheese" value="yes"/ checked="checked" >
        				<span class="choose-list-target"></span>
    					</label>
						</div>
					</li>
					<li class="dropdown-list__item">
						<div class="choose-list">
						
    					<label class="choose-list">
    					<img src="{{ asset('img/90.png') }}" alt="">
    					<span>Ссылка</span>
						
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
    					<span>Событие</span>
						
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
    
			 	<div class="cube"><a href="{{URL::to('profile/random')}}"></a></div>
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
	</div>
</div>