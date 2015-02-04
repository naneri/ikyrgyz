@if(Auth::check())
<div class="b-header">
    <div class="navbar navbar-default">
      <div class="container-fluid">
        <ul class="nav nav-justified">
          <li><a href="#"> <img src="{{ asset('img/2.png') }}" alt="logo"/><span>I-kyrgyz</span></a></li>
          <li class="dropdown"><a href="#"><img src="{{ asset('img/3.png') }}" alt="user"/><span>Имя пользователя</span></a>
            <ul role="menu" aria-labelledby="dLabel" class="dropdown-menu">
              <li><a href="#">Изменить профиль</a></li>
              <li><a href="#">Личные сообщения (1877)</a></li>
              <li><a href="#">Друзья</a></li>
              <li><a href="#">Группы</a></li>
            </ul>
          </li>
          <li><a href="#"><img src="{{ asset('img/4.png') }}" alt="user"/><span class="counter">25</span></a></li>
          <li><a href="#"><img src="{{ asset('img/5.png') }}" alt="count"/><span class="counter">25</span></a></li>
          <li><a href="#"><img src="{{ asset('img/6.png') }}" alt="count"/><span class="counter">25</span></a></li>
          <li><a href="{{URL::to('search/people')}}"> <img src="{{ asset('img/7.png') }}" alt="search"/><span>Поиск друзей</span></a></li>
          <li class="dropdown"><a href="#"><img src="{{ asset('img/8.png') }}" alt="book"/><span>Энциклопедия</span></a>
            <ul role="menu" aria-labelledby="dLabel" class="dropdown-menu">
              <li><a href="#">История</a></li>
              <li><a href="#">Обычаи</a></li>
              <li><a href="#">Культура</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href=""><img src="{{ asset('img/9.png') }}" alt="help"/></a>
            <ul role="menu" aria-labelledby="dLabel" class="dropdown-menu">
              <li><a href="#">Помощь</a></li>
              <li><a href="#">Сообщить о проблеме</a></li>
              <li><a href="#">История действии</a></li>
            </ul>
          </li>
          <li><a href="#"><img src="{{ asset('img/10.png') }}" alt="language"/></a></li>
          <li><a href="#"><img src="{{ asset('img/11.png') }}" alt="closebtn"/></a></li>
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