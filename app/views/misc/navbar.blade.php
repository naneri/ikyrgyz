@if(Auth::check())
<div class="b-header">
		<div class="b-header__inner">
			<div class="b-header-nav">
				<a href="#" class="b-header-nav__icon">
					<div></div>
					<div></div>
					<div></div>
				</a>
				<ul class="b-header-nav-list">
					<li class="b-header-nav__left">
						<div class="b-header-nav-logo">
							<div class="b-header-nav-logo__item"><a href="{{ URL::to('/') }}"><img src="{{ asset('img/2.png') }}"  alt="logo"/><span class="logo">{{Config::get('app.network_name')}}I-bylorussian</span></a></div>
						</div>
						<div class="b-header-nav-user">
							<div class="b-header-nav-user__item">
							<a href="#">
						@if(isset($user_data->description->user_profile_avatar))
							<img class="header-logo__image"  src="{{ asset($user_data->description->user_profile_avatar) }}" alt="user"/>
						@else
							<img class="header-logo__image" src="{{ asset('img/38.png') }}" alt="user"/>
						@endif
						<span class="user-name">{{@$user_data['description']->first_name.' '.@$user_data['description']->last_name}}</span>
						

						</a>
						<ul class="b-header-nav-dropdown">
							<li><a href="{{ URL::to('profile') }}">{{ trans('network.my-profile') }}</a></li>
							<li><a href="{{ URL::to('messages/inbox/all') }}">{{ trans('network.personal-messages') }}</a></li>
							<li><a href="{{ URL::to('profile/friends') }}">{{ trans('network.friends') }}</a></li>
							<!--<li><a href="{{ URL::to('group/create')  }}">Группы</a></li>-->
						</ul>
							

						</div>
						</div>
					</li>
					<li class="b-header-nav__middle">
						<div class="b-header-nav-button">
							<div class="b-header-nav-button__item">
								@if(count(@$new_messages))
								<a href="#" class="counter-block">
									<img src="{{ asset('img/navbar/mail_act.png') }}" alt="msg"/>
									<span class="counter">{{count($new_messages)}}</span>
								</a>
									<ul class="b-header-nav-dropdown b-header-nav-dropdown-message">
									@foreach($new_messages as $message)
									<li>
										<a href="{{ URL::to('message/show'). '/' . $message->id }}">
										<div class="b-header-nav-dropdown__message">
											@if(isset($message->user_profile_avatar))
												<img src="{{$message->user_profile_avatar}}" alt="" class="header-dropdown-image"/>
											@else
												
											@endif
											<p class="text text-name">{{$message->first_name}} {{$message->last_name}}</p>
											<p class="text text-message">{{mb_substr(strip_tags($message->title), 0 ,50, 'UTF-8')}}</p>
										</div>  
										</a>
									</li>
									@endforeach
								</ul>
							 
							@else
							<a href="#" class="counter-block">
								<img src="{{ asset('img/navbar/mail_inact.png') }}" alt="msg"/>
								<span style="opacity:0" class="counter">{{count($new_messages)}}</span>
							</a>
							@endif

							</div>
							<div class="b-header-nav-button__item">
								@if(count(@$friend_requests))
							<a href="#" class="counter-block">
								<img src="{{ asset('img/navbar/f_req_act.png') }}" alt="msg"/>
								<span class="counter">{{count($friend_requests)}}</span>
							</a> 
								<ul class="b-header-nav-dropdown">
									@foreach($friend_requests as $friend)
										<li>
											@if(!empty($friend->user_profile_avatar))
												<img src="{{$friend->user_profile_avatar}}" alt="">
											@endif
										<span>{{$friend->first_name . ' ' . $friend->last_name }}<br/>{{ trans('network.sent-you-message') }}</span><br/><a href="{{ URL::to('people/submitFriend'). '/' . $friend->id }}" class="btn">{{ trans('network.accept') }}</a>  <a href="{{ URL::to('people/removeFriend'). '/' .  $friend->id }}" class="btn">{{ trans('network.reject') }}</a></li>
									@endforeach
								</ul>  
							 
							@else
							<a href="#" class="counter-block">
								<img src="{{ asset('img/navbar/f_req_inact.png') }}" alt="msg"/>
								<span style="opacity:0" class="counter">{{count($friend_requests)}}</span>
								 </a>
							@endif
							</div>
							<div class="b-header-nav-button__item">
							<a href="#" class="counter-block">
							<img src="{{ asset('img/navbar/setting_inact.png') }}" alt="msg"/>
							<span style="opacity:0" class="counter">25</span>
						</a>
							</div>
						</div>
					</li>

					<li class="b-header-nav__right">
						<div class="b-header-nav-search">
							<div class="b-header-nav-search__item"><a href="{{ URL::to('search/people') }}">
							<img src="{{ asset('img/navbar/friend_search.png') }}" alt="search"/>
							<span class="search-friend">{{ trans('network.search_friends') }}</span>
						</a></div>
						</div>
						<div class="b-header-nav-enc">
							<div class="b-header-nav-enc__item"><a href="#">
							<img src="{{ asset('img/navbar/encyclopedia.png') }}" alt="search"/>
							<span class="search-friend">{{ trans('network.encyclopedia') }}</span>
						</a>
						<ul class="b-header-nav-dropdown">
							<li><a href="{{ URL::to('custom/history') }}">{{ trans('network.history') }}</a></li>
							<li><a href="{{ URL::to('custom/customs') }}">{{ trans('network.customs') }}</a></li>
							<li><a href="{{ URL::to('custom/culture') }}">{{ trans('network.culture') }} </a></li>
						</ul></div>
						</div>
						<div class="b-header-nav-setting">
							<div class="b-header-nav-setting__item">
								<a href="#"><img src="{{ asset('img/39.png') }}" alt="search"/></a>
						<ul class="b-header-nav-dropdown">
						 
							<li><a href="#">{{ trans('network.language-choice') }}</a>
								<ul class="b-header-sub-menu">
									<li><a href="{{ URL::to('locale/en') }}"><img src="{{ asset('img/30.png') }}" alt=""/><span>English</span></a></li>
									<li><a href="{{ URL::to('locale/ru') }}"><img src="{{ asset('img/30.png') }}" alt=""/><span>Русский</span></a></li>
								</ul>
							</li>
						 
							<!--
							<li><a href="#">Помощь</a>
								<ul class="b-header-sub-menu">
									<li><a href="">Сообщить о проблеме</a></li>
									<li><a href="">История действии</a></li>
								</ul>
							</li>
							-->
							<li><a href="{{ URL::to('logout') }}">{{ trans('network.exit') }}</a></li>
							</div>
						</div>
					</li>
					<div class="clear"></div>

					
					
				
					
						
					
					
						</ul>
					</li>
					<div class="clear"></div>
				</ul>
			</div>
		</div>
	</div>
@endif


<div class="container">
	<div class="col-md-12">
		{{Session::get('message')}}<br>
	</div>
</div>
