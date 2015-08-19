
 



  

<div class="b-topic-navigation menu">
	<div class="b-topic-navigation__inner ">
		<div class="b-topic-navigation__left">
			<div class="b-topic-navigation-menu">
				@if(Auth::check())
				<div class="b-topic-navigation-menu__list">
					<a style="text-transform: uppercase;" href="#" class="arrow">Я-{{trans('nation.'.Config::get('app.nation_name'))}}</a>
					<dl class="dropdown-list">
						<dt><a href="{{URL::to('profile')}}" class="my-profile">{{ trans('network.my-profile') }}</a></dt>
							<dd><a href="{{URL::to('topic/myTopics')}}">{{ trans('network.publications') }}
							<span class="raiting">{{$topic_number}}</span>
							</a> </dd>
							<dd><a href="{{ URL::to('profile/messages') }}">{{ trans('network.personal-messages') }}
							<span class="raiting">{{count($new_messages)}}</span>
							</a></dd>
							<dd><a href="{{ URL::to('profile/friends') }}">{{ trans('network.friends') }}
							<span class="raiting">{{$friend_number}}</span>
							</a></dd>
							<!-- <dd><a href="{{URL::to('profile/subscriptions')}}">Подписки</a><span class="raiting">143</span></dd> -->
							<dd><a href="{{URL::to('topic/favorites')}}">{{ trans('network.favorite') }}
							<span class="raiting">{{$favorites}}</span>
							</a></dd>
						<dt>{{ trans('network.encyclopedia') }}</dt>
							<dd><a href="{{ URL::to('custom/history') }}">{{ trans('network.history') }}</a></dd>
							<dd><a href="{{ URL::to('custom/customs') }}">{{ trans('network.customs') }}</a></dd>
							<dd><a href="{{ URL::to('custom/culture') }}">{{ trans('network.culture') }} </a></dd>
						<!-- <dt>Помощь</dt>
							<dd><a href="">Сообщить о проблеме</a></dd> -->
						<!-- 	<dd><a href="">Истоиря действии</a></dd>	 -->
						<dt>{{ trans('network.settings') }}</dt>
							<dd>
							<span class="lang-text">{{ trans('network.choose-lang-imperative') }}</span>
							<a href="{{ URL::to('locale/ru') }}">
								<img src="{{ asset('img/103.png') }}" alt=""/>
							</a>
							<a href="{{ URL::to('locale/en') }}">
								<img src="{{ asset('img/104.png') }}" alt=""/>
							</a>
							<div class="clear"></div>
							</dd>

						<dt><a href="{{ URL::to('logout') }}">{{ trans('network.exit') }}</a>
						</dt>	

					</dl>

				</div>
				@else
				
				@endif	
			</div>
			<div class="b-topic-navigation-sort">
				<ul>
					<li class="b-topic-navigation-sort__item">
						<a href="{{URL::to('main/index')}}" title="Новые топики"></a>
						
					</li>
					<li class="b-topic-navigation-sort__item">
						<a href="{{URL::to('main/index/top')}}" title="По рейтингу"></a>
					</li>
					<li class="b-topic-navigation-sort__item">
						<a href="#" title="В избранном"></a>
					</li>
				
				</ul>
				
				<a href="#"></a>
				<a href="#"></a>
				<div class="clear"></div>
			</div>
			<div class="b-topic-navigation-category">
				<ul>
					<li class="b-topic-navigation-category__item item1">
						<a href="{{URL::to('topic/videos')}}" title="Видео"></a>
					</li>
					<li class="b-topic-navigation-category__item item2">
						<a href="#" title="Фото"></a>
					</li>
					<li style="display:none" class="b-topic-navigation-category__item item3">
						<a href="#" ></a>
					</li>
					<li class="b-topic-navigation-category__item item4">
						<a href="{{URL::to('topic/linkTopics')}}" title="Ссылки"></a>
					</li>
					<li style="display:none" class="b-topic-navigation-category__item item5">
						<a href="#" ></a>
					</li>
					<li style="display:none" class="b-topic-navigation-category__item item6">
						<a href="#"></a>
					</li>
				</ul>
				
				<div class="clear"></div>
			</div>
			<div class="b-topic-navigation-choose">
				<div class="b-topic-navigation-choose__list">
				<a href="#" class="b-topic-navigation-choose__item"></a>
				<ul class="dropdown-list">
					<li class="dropdown-list__item dropdown-list__item_title">
					{{ trans('network.sort-topics-by') }}</li>
					<li class="dropdown-list__item">
					
						<div class="choose-list">
    					
    					<img src="{{ asset('img/87.png') }}" alt="">
    					<span>{{ trans('network.video') }}</span>
       					 <input type="checkbox" class="bigcheck bigcheck1 " name="cheese" value="{{ trans('network.yes') }}" checked="checked"/>
        				<span class="choose-list-target"></span>
    					
						</div>
					</li>
					<li class="dropdown-list__item">
						<div class="choose-list">
    					
    					<img src="{{ asset('img/88.png') }}" alt="">
    					<span>Фото</span>
       					 <input type="checkbox" class="bigcheck bigcheck2" name="cheese" value="{{ trans('network.yes') }}" checked="checked"/>
        				<span class="choose-list-target"></span>
    					
						</div>
					</li>
					<!-- <li class="dropdown-list__item">
						<div class="choose-list">
						
					    					<label class="choose-list">
					    					<img src="{{ asset('img/89.png') }}" alt="">
					    					<span>Аудио</span>
						
					       					 <input type="checkbox" class="bigcheck bigcheck3" name="cheese" value="yes"/ checked="checked" >
					        				<span class="choose-list-target"></span>
					    					</label>
						</div>
					</li> -->
					<li class="dropdown-list__item">
						<div class="choose-list">
						
    					
    					<img src="{{ asset('img/90.png') }}" alt="">
    					<a href="{{URL::to('topic/linkTopics')}}"><span>Ссылка</span></a>
						
       					 <input type="checkbox" class="bigcheck bigcheck4" name="cheese" value="{{ trans('network.yes') }}"/ checked="checked">
        				<span class="choose-list-target"></span>
    					
						</div>
					</li>
					<!-- <li class="dropdown-list__item">
						<div class="choose-list">
						
					    					<label class="choose-list">
					    					<img src="{{ asset('img/91.png') }}" alt="">
					    					<span>Видео</span>
						
					       					 <input type="checkbox" class="bigcheck bigcheck5" name="cheese" value="yes"/ checked="checked">
					        				<span class="choose-list-target"></span>
					    					</label>
						</div>
					</li> -->
					<!-- <li class="dropdown-list__item">
						<div class="choose-list">
						
					    					<label class="choose-list">
					    					<img src="{{ asset('img/92.png') }}" alt="">
					    					<span>Событие</span>
						
					       					 <input type="checkbox" class="bigcheck bigcheck6" name="cheese" value="yes"/ checked="checked">
					        				<span class="choose-list-target"></span>
					    					</label>
						</div>
					</li> -->
					
				</ul>
			</div>
			</div>
			<div class="clear"></div>
		</div>	
		<div class="b-topic-navigation__right">
			 	<div class="cube"><a href="{{URL::to('profile/random')}} "  title="Случайный профиль">
			 	
			 	</a></div>

			 
				<!-- <div class="b-topic-navigation-line">
				
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
				</div> -->
				<div class="b-topic-navigation-format">
					<a href="#" class="b-topic-navigation-format__item "  title="вид ленты"></a>
					<ul class="dropdown-list">
						<li class="format-list"><a href="javascript: makeColumnN('1')" title="{{ trans('network.one-column') }}"></a></li>
						<li class="format-list"><a href="javascript: makeColumnN('2')" title="{{ trans('network.two-column') }}"></a></li>
						<li class="format-list"><a href="javascript: makeColumnN('3')" title="{{ trans('network.three-column') }}"></a></li>
					</ul>
				</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
