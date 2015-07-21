
<div id="overlay"></div>
<div class="b-header">
		<div class="b-header__inner">
			<div class="b-header-nav">
				<!-- <ul class="b-header-mobile-nav-list">
					<li class="b-header-mobile-nav-list__left">
						


					</li>
					<li class="b-header-mobile-nav-list__middle"></li>
					<li class="b-header-mobile-nav-list__right"></li>
				</ul> -->
				<div class="b-header-nav-menu">
					<div class="b-header-nav-menu__item">
						<a href="#"></a>
					</div>	
						<div class="b-topic-navigation-menu">
				<div class="b-topic-navigation-menu__list">				
					<dl class="dropdown-list">
						<dt class="title"><a href="{{ URL::to('/') }}" class="soc-name">Я-Кыргыз</a></dt>
						<dt class="user-name"><a href="{{URL::to('profile')}}">
						@if(isset($user_data->description->user_profile_avatar))
						<img src="{{ asset($user_data->description->user_profile_avatar) }}" alt="">
						@else

						<img src="{{ asset('img/48.png') }}" alt="">
						@endif
						<span class="user-name">{{@$user_data['description']->first_name.' '.@$user_data['description']->last_name}}</span>
						</a></dt>
						<dt><a href="{{URL::to('profile')}} " class="my-profile">Мой профиль</a></dt>

							<dd><a href="{{URL::to('topic/myTopics')}}">{{ trans('network.publications') }}
							<span class="raiting">{{@$topic_number}}</span>
							</a> </dd>
							<dd><a href="{{ URL::to('profile/messages') }}">{{ trans('network.personal-messages') }}
							<span class="raiting">{{count(@$new_messages)}}</span>
							</a></dd>
							<dd><a href="{{ URL::to('profile/friends') }}">{{ trans('network.friends') }}
							<span class="raiting">{{@$friend_number}}</span>
							</a></dd>
							<!-- <dd><a href="{{URL::to('profile/subscriptions')}}">Подписки</a><span class="raiting">143</span></dd> -->
							<dd><a href="{{URL::to('topic/favorites')}}">{{ trans('network.favorite') }}
							<span class="raiting">{{@$favorites}}</span>
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
							<span class="lang-text">Выберите язык</span>
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
			</div>
					
					
				</div>
               
				<ul class="b-header-nav-list">
					<li class="b-header-nav__left">
						<div class="b-header-nav-logo">
							<div class="b-header-nav-logo__item"><a href="{{ URL::to('/') }}"><img src="{{ asset('img/2.png') }}"  alt="logo"/><span class="logo beta">Beta</span></a></div>
						</div>
						<div class="b-header-nav-user">
                            <div class="b-header-nav-user__item">
                                @if(@Auth::check())
                                    <a href="{{ URL::to('profile') }}">
                                    @if(isset($user_data->description->user_profile_avatar))
                                        <img class="header-logo__image"  src="{{ asset($user_data->description->user_profile_avatar) }}" alt="user"/>
                                    @else
                                        <img class="header-logo__image" src="{{ asset('img/38.png') }}" alt="user"/>
                                    @endif
                                    <span class="user-name">{{@$user_data['description']->first_name.' '.@$user_data['description']->last_name}}</span>
                                    </a>
                                @endif
                           </div>
						</div>
					</li>
                    @if(@Auth::check())
					<li class="b-header-nav__middle">
						<div class="b-header-nav-button">
							<div class="b-header-nav-button__item">
								@if(count(@$new_messages))
								<a href="{{URL::to('profile/messages')}}" class="counter-block">
									<img src="{{ asset('img/navbar/mail_act.png') }}" alt="msg"/>
									<span class="counter">{{count(@$new_messages)}}</span>
								</a>
									<ul class="b-header-nav-dropdown b-header-nav-dropdown-message">
									@foreach($new_messages as $message)
									<li>
										<a href="{{ URL::to('profile/messages'). '?message:' . $message->id }}">
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
							<a class="counter-block">
								<img src="{{ asset('img/navbar/mail_inact.png') }}" alt="msg"/>
								<span style="opacity:0" class="counter">{{count(@$new_messages)}}</span>
							</a>
							@endif

							</div>
							<div class="b-header-nav-button__item">
								@if(count(@$friend_requests))
							<a class="counter-block">
								<img src="{{ asset('img/navbar/f_req_act.png') }}" alt="msg"/>
								<span class="counter">{{count(@$friend_requests)}}</span>
							</a> 
								<ul class="b-header-nav-dropdown b-header-nav-dropdown_add-btn">
									@foreach($friend_requests as $friend)
										<li>
											<div class="b-header-nav-dropdown__wrapper">
												
											@if(!empty($friend->user_profile_avatar))
												<img src="{{$friend->user_profile_avatar}}" alt="" class="b-header-nav-dropdown__image">
											@endif
										<div class="b-header-nav-dropdown__item">
											<span>{{$friend->first_name . ' ' . $friend->last_name }}<br/>{{ trans('network.sent-you-message') }}</span><br/><a href="{{ URL::to('people/submitFriend'). '/' . $friend->id }}" class="btn">{{ trans('network.accept') }}</a>  <a href="{{ URL::to('people/removeFriend'). '/' .  $friend->id }}" class="btn">{{ trans('network.reject') }}</a>
										</div>
										</div>
										</li>
										
									@endforeach
								</ul>  
							 
							@else
							<a class="counter-block">
								<img src="{{ asset('img/navbar/f_req_inact.png') }}" alt="msg"/>
								<span style="opacity:0" class="counter">{{count(@$friend_requests)}}</span>
								 </a>
							@endif
							</div>

							<div class="b-header-nav-button__item">
                            @if(count(@$notes))
                            <a class="counter-block">
                                <img src="{{ asset('img/navbar/setting_act.png') }}" alt="msg"/>
                                <span class="counter">{{count($notes)}}</span>
                            </a> 
                            <ul class="b-header-nav-dropdown b-header-nav-dropdown_add-btn">
                                <li>
                                        <div class="b-header-nav-dropdown__wrapper">
                                            <div class="b-header-nav-dropdown__item">
                                               
                                                    <a href="{{URL::to('notifications/all')}}">
                                                        {{ trans('network.watch-all-notification') }}
                                                    </a>

                                            </div>
                                        </div>
                                    </li>
                                @foreach($notes as $note)
                                    <li>
                                        <div class="b-header-nav-dropdown__wrapper">
                                            <div class="b-header-nav-dropdown__item">
                                               
                                                    <a href="{{URL::to('notifications/all')}}">
                                                        {{Lang::choice($note->lang_message, $note->total, [$note->total])}}
                                                    </a>

                                            </div>
                                        </div>
                                    </li>
                                    
                                @endforeach
                            </ul>  
                            @else
							<a class="counter-block">
    							<img src="{{ asset('img/navbar/setting_inact.png') }}" alt="msg"/>
    							<span style="opacity:0" class="counter">25</span>
    						</a>
                            @endif
							</div>
						</div>
					</li>
                    @endif
                    @if(@Auth::check())
					<li class="b-header-nav__right">
						<div class="b-header-nav-search">
							<input type="text" class="b-header-nav-search__item" id="nav-bar-search-field" placeholder="{{ trans('network.search') }}">
						</div>
                        <div class="b-header-nav-search-results" >
                        	<button id="show-all-results">{{ trans('network.show-all-results') }}</button>
                            <div class="b-header-nav-search-results-people">
                                <div></div>
                            </div>
                            <div class="b-header-nav-search-results-content">
                                <div></div>
                            </div>
                            
                        </div>
					</li>
                    @endif
					<div class="b-header-nav-random">
						<div class="b-header-nav-random__item">
							<a href="{{URL::to('profile/random')}}"></a>
						</div>
					</div>
					<div class="b-header-nav-icon-search">
						<div class="b-header-nav-icon-search__item">
							<a href="#"></a>
						</div>
					</div>
					<div class="clear"></div>
						</ul>
					</li>
					<div class="clear"></div>
				</ul>

			</div>
		</div>
	</div>

<div class="container">
	<div class="col-md-12">
		@if(Session::get('message'))
		<div class="b-message b-message-{{Session::get('message.type')}}"><a href="javascript: $(`.b-message`).remove()" class="b-message-close"></a>
			<div class="b-message-icon b-message-{{Session::get('message.type')}}-icon"></div>
			<p class="b-message-p">
				{{Session::get('message.text')}}<br>
			</p>
		</div>
		@endif
	</div>
</div>


@if(isset($base_config))
    <script type="text/javascript">
        var timer = null;
        var $searchField = $('#nav-bar-search-field');
        $('html').click(function() {
            $('.b-header-nav-search-results-content').css("display", "none");
            $('.b-header-nav-search-results-people').css("display", 'none');
            $('#show-all-results').css("display", 'none');
        });
        $searchField.on('focus', function () {
            setNavSearchTimeout();
        });
        $searchField.on('keyup', function(event){
            if(event.keyCode == 13)
                $("#show-all-results").click()
            else
                setNavSearchTimeout();
        });
        $('#show-all-results').on('click', function () {
            location.href = "{{$base_config['base_url']}}/search/?search-text="+$searchField.val();
        });

        function setNavSearchTimeout(){
            if (timer) {
                clearTimeout(timer); //cancel the previous timer.
                timer = null;
            }
            timer = setTimeout(updateSearchResults, 500);
        }

        function updateSearchResults()
        {
            if ($searchField.val().trim() != "") {
                $.ajax({
                    method: "POST",
                    url: "{{$base_config['base_url']}}/search/ajax-people/",
                    data: {
                        'search-text': $searchField.val()
                    },
                    success: function(html) {
                        if (html.length > 0) {
                            $('.b-header-nav-search-results-people').css("display", 'block');
                            $('.b-header-nav-search-results-people div').html(html);
                        } else {
                            $('.b-header-nav-search-results-people').css("display", 'none');
                            $('.b-header-nav-search-results-people div').html("");
                        }
                        $('#show-all-results').css("display", 'block');
                    }
                });
                $.ajax({
                    method: "POST",
                    url: "{{$base_config['base_url']}}/search/ajax-content/",
                    data: {
                        'search-text': $searchField.val()
                    },
                    success: function(html) {
                        if (html.length > 0) {
                            $('.b-header-nav-search-results-content').css("display", "block");
                            $('.b-header-nav-search-results-content div').html(html);
                        } else {
                            $('.b-header-nav-search-results-content').css("display", "none");
                            $('.b-header-nav-search-results-content div').html("");
                        }
                        $('#show-all-results').css("display", 'block');
                    }
                });
            } else {

            }
        }
    </script>
    <style>
        .b-profile-about-tags-user__right .btn.favourite{
            background: #FFCC79;
        }
    </style>
@endif