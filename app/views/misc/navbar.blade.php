@if(Auth::check())
<div class="b-header">
          <div class="b-header__inner">
            <div class="b-header-nav">
              <ul>
                <li class="b-header-nav__list"><a href="{{ URL::to('/') }}"><img src="{{ asset('img/2.png') }}" alt="logo"/><span class="logo">I-Kyrgyz</span></a></li>
                <li class="b-header-nav__list"><a href="#">
                  @if(isset($user_data->description->user_profile_avatar))
                    <img style="width:40px" src="{{ asset($user_data->description->user_profile_avatar) }}" alt="user"/>
                  @else
                    <img src="{{ asset('img/38.png') }}" alt="user"/>
                  @endif
                  <span class="user-name">{{@$user_data['description']->first_name.' '.@$user_data['description']->last_name}}</span></a>
                  <ul class="b-header-nav-dropdown">
                    <li><a href="{{ URL::to('profile/edit/main') }}">Изменить профиль</a></li>
                    <li><a href="{{ URL::to('messages/inbox/all') }}">Личные сообщения</a></li>
                    <li><a href="{{ URL::to('profile/friends') }}">Друзья</a></li>
                    <!--<li><a href="{{ URL::to('group/create')  }}">Группы</a></li>-->
                  </ul>
                </li>
                <li class="b-header-nav__list">
                  <a href="{{ URL::to('messages/inbox/all') }}" class="counter-block">
                    @if(count(@$new_messages))
                      <img src="{{ asset('img/navbar/mail_act.png') }}" alt="msg"/>
                      <span class="counter">{{count($new_messages)}}</span>
                      <ul class="b-header-nav-dropdown">
                        <li><a href="#">Изменить профиль</a></li>
                        <li><a href="#">Личные сообщения(1877)</a></li>
                        <li><a href="#">Друзья</a></li>
                        <li><a href="#">Группы  </a></li>
                      </ul>
                    @else
                      <img src="{{ asset('img/navbar/mail_inact.png') }}" alt="msg"/>
                      <span style="opacity:0" class="counter">{{count($new_messages)}}</span>
                    @endif
                  </a>
                </li>
                <li class="b-header-nav__list">  
                  
                    @if(count(@$friend_requests))
                    <a href="#" class="counter-block">
                      <img src="{{ asset('img/navbar/f_req_act.png') }}" alt="msg"/>
                      <span class="counter">{{count($friend_requests)}}</span>
                      </a> 
                      <ul class="b-header-nav-dropdown">
                        @foreach($friend_requests as $request)
                          <li>{{$request->first_name . ' ' . $request->last_name . 'отправил вам приглашение в друзья'}}<a href="{{ URL::to('people/submitFriend'). '/' . $request->id }}">Принять</a> | <a href="{{ URL::to('people/removeFriend'). '/' . $request->id }}">Отклонить</a></li>
                        @endforeach
                      </ul>  
                     
                    @else
                    <a href="#" class="counter-block">
                      <img src="{{ asset('img/navbar/f_req_inact.png') }}" alt="msg"/>
                      <span style="opacity:0" class="counter">{{count($friend_requests)}}</span>
                       </a>
                    @endif
                  
                 </li> 
                 <li class="b-header-nav__list"> 
                  <a href="#" class="counter-block">
                    <img src="{{ asset('img/navbar/setting_inact.png') }}" alt="msg"/>
                    <span style="opacity:0" class="counter">25</span>
                  </a>
                </li>
                <li class="b-header-nav__list">
                  <a href="{{ URL::to('search/people') }}">
                    <img src="{{ asset('img/navbar/friend_search.png') }}" alt="search"/>
                    <span class="search-friend">Поиск друзей</span>
                  </a>
                </li>
                <li class="b-header-nav__list">
                  <a href="#">
                    <img src="{{ asset('img/navbar/encyclopedia.png') }}" alt="search"/>
                    <span class="search-friend">Энциклопедия</span>
                  </a>
                  <ul class="b-header-nav-dropdown">
                    <li><a href="">История</a></li>
                    <li><a href="">Обычаи</a></li>
                    <li><a href="">Культура </a></li>
                  </ul>
                </li>
                <li class="b-header-nav__list"><a href="#"><img src="{{ asset('img/39.png') }}" alt="search"/></a>
                  <ul class="b-header-nav-dropdown">
                    <li><a href="#">Выбор языка</a>
                      <ul class="b-header-sub-menu">
                        <li><a href=""><img src="{{ asset('img/30.png') }}" alt=""/><span>Английский</span></a></li>
                        <li><a href=""><img src="{{ asset('img/30.png') }}" alt=""/><span>Русский</span></a></li>
                        <li><a href=""><img src="{{ asset('img/30.png') }}" alt=""/><span>Русский  </span></a></li>
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
                    <li><a href="{{ URL::to('logout') }}">Выход</a></li>
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

<!--  <div class="b-header">
        <div class="b-header__inner">
          <div class="b-header__logo"><a href="{{ URL::to('main/index') }}"><img src="{{ asset('img/content/logo__image.png') }}" alt=""/><span>I-KYRGYZ</span></a></div>
          <div class="b-header__menu"><a href="#">&#9776;</a></div>
          <div class="b-header__navigation">
            <ul>
              <li><a href="#" class="b-header__user">
                @if(isset($user_data['description']->user_profile_avatar))
                  <img style="height:49px;width:49px" src="{{$user_data['description']->user_profile_avatar}}" alt=""/>
                @else
                  <img src="{{URL::to('/img')}}/content/user-name.png" alt=""/>
                @endif
                <span>Ярослав...</span></a>
                <ul class="b-header-sub-menu">
                  <li><a href="{{ URL::to('profile/edit') }}">Изменить профиль</a></li>
                  <li><a href="{{ URL::to('message/all') }}">Личные сообщения(1877)</a></li>
                  <li><a href="{{ URL::to('profile/friends') }}">Друзья</a></li>
                  <li><a href="#">Группы</a></li>
                </ul>
              </li>
              <li class="b-header__list-count"><a href="#"><img src="{{ asset('img/content/message.png') }}" alt=""/></a><span class="nav-count">25</span></li>
              <li class="b-header__list-count"><a href="#"><img src="{{ asset('img/content/friends.png') }}" alt=""/></a><span class="nav-count">25</span></li>
              <li class="b-header__list-count"><a href="#"><img src="{{ asset('img/content/setting2.png') }}" alt=""/></a><span class="nav-count">25</span></li>
              <li><a href="{{ URL::to('people') }}"><img src="{{ asset('img/content/search-btn.png') }}" alt=""/><span>Поиск друзей</span></a></li>
              <li class="b-header__list-enc"><a href="#"><img src="{{ asset('img/content/enc.png') }}" alt=""/><span>Энциклопедия</span></a>
                <ul class="sub-menu-enc">
                  <li><a href="#">привет</a></li>
                  <li><a href="#">привет как дела</a></li>
                  <li><a href="#">чем занимаешься,</a></li>
                </ul>
              </li>
              <li><a href="#"><img src="{{ asset('img/content/setting.png') }}" alt=""/></a>
                <ul class="sub-menu-setting">
                  <li><a href="#"><span>Выбор языка</span></a>
                    <ul class="item1">
                      <li><a href="#"><img src="{{ asset('img/content/flag.png') }}" alt=""/><span>Русский</span></a></li>
                      <li><a href="#"><img src="{{ asset('img/content/flag.png') }}" alt=""/><span>Русский</span></a></li>
                      <li><a href="#"><img src="{{ asset('img/content/flag.png') }}" alt=""/><span>Русский</span></a></li>
                      <div class="clear"></div>
                    </ul>
                  </li>
                  <li><a href="#">помощь</a>
                    <ul class="item2">
                      <li class="sub-menu-ask"><a href="#">asdasd</a></li>
                      <li class="sub-menu-ask"><a href="#">asdasd</a></li>
                    </ul>
                  </li>
                  <li><a href="{{ URL::to('logout') }}">выход</a></li>
                </ul>
              </li>
            </ul>
          </div>
          <div class="clear"></div>
        </div>
      </div>
--> 


<!--<div class="b-header">
      <div class="b-header__inner">
        <div class="b-header__logo"><a href="{{URL::to('/')}}"><img src="{{URL::to('/img')}}/content/logo__image.png" alt=""/><span>I-KYRGYZ</span></a></div>
        <div class="b-header__menu"><a href="#">&#9776;</a></div>
        <div class="b-header__navigation">
          <ul class="menu dropit">
            <li class="dropit-trigger dropit-open"><a href="#">
              
              <span>Имя пользователя</span></a>
              <ul class="dropit-submenu dropdown dropdown-margin">
                <li><a href="{{URL::to('profile/edit')}}">Изменить профиль</a></li>
                <li><a href="{{URL::to('message/all')}}">Личные сообщения(1877)</a></li>
                <li><a href="{{URL::to('profile/friends')}}">Друзья</a></li>
                <li><a href="">Группы</a></li>
              </ul>
            </li>
            <li><a href="#"><img src="{{URL::to('/img')}}/content/message.png" alt=""/><span>25</span></a></li>
            <li><a href="#"><img src="{{URL::to('/img')}}/content/friends.png" alt=""/><span>25</span></a></li>
            <li><a href="#"><img src="{{URL::to('/img')}}/content/setting2.png" alt=""/><span>25</span></a></li>
            <li><a href="{{URL::to('people')}}"><img src="{{URL::to('/img')}}/content/search-btn.png" alt=""/><span>Поиск друзей</span></a></li>
            <li class="enc"><a href="#"><img src="{{URL::to('/img')}}/content/enc.png" alt=""/><span>Энциклопедия</span></a>
              <ul class="dropdown">
                <li><a href="">item</a></li>
                <li><a href="">item</a></li>
                <li><a href="">item  </a></li>
              </ul>
            </li>
            <li><a href="#"><img src="{{URL::to('/img')}}/content/ask.png" alt=""/></a>
              <ul class="dropdown">
                <li><a href="">item</a></li>
                <li><a href="">item</a></li>
                <li><a href="">item  </a></li>
              </ul>
            </li>
            <li class="flag"><a href="#"><img src="{{URL::to('/img')}}/content/flag.png" alt=""/></a>
              <ul class="dropdown">
                <li><a href=""> Lorem ipsum dolor sit amet.</a></li>
                <li><a href="">item</a></li>
                <li><a href="">item</a></li>
              </ul>
            </li>
            <li><a href="{{URL::to('/logout')}}"><img src="{{URL::to('/img')}}/content/close.png" alt=""/></a></li>
          </ul>
        </div>
        <div class="clear"></div>
      </div>
    </div> -->