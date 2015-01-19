@if(Auth::check())
	<div class="b-header">
      <div class="b-header__inner">
        <div class="b-header__logo"><a href="{{URL::to('/')}}"><img src="{{URL::to('/img')}}/content/logo__image.png" alt=""/><span>I-KYRGYZ</span></a></div>
        <div class="b-header__menu"><a href="#">&#9776;</a></div>
        <div class="b-header__navigation">
          <ul class="menu dropit">
            <li class="dropit-trigger dropit-open"><a href="#"><img src="{{URL::to('/img')}}/content/user-name.png" alt=""/><span>Имя пользователя</span></a>
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
                <li><a href="">item	 </a></li>
              </ul>
            </li>
            <li><a href="#"><img src="{{URL::to('/img')}}/content/ask.png" alt=""/></a>
              <ul class="dropdown">
                <li><a href="">item</a></li>
                <li><a href="">item</a></li>
                <li><a href="">item	 </a></li>
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
    </div>


	

@endif

<div class="container">
	<div class="col-md-12">
		{{Session::get('message')}}<br>
	</div>
</div>