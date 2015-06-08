<div class="b-message tab-content current">
    <div class="b-message-tabs">
        <div class="b-message-tabs-list">
            <ul class="tab">
                <li class="b-message-tabs-list__list tab-link currents" data-tab="tabs-1" ><a href="#"><img src="{{asset('img/115.png') }}" alt="">Личные сообщения</a></li>
                <li class="b-message-tabs-list__list" data-tab="tabs-2"><a href="#"><img src="{{asset('img/116.png') }}" alt="">Новые друзья</a></li>
                <li class="b-message-tabs-list__list"><a href=""><img src="{{asset('img/117.png') }}" alt="">Оповещения</a></li>
                <div class="clear"></div>
            </ul>
        </div>
    </div>
    <div class="b-message-ls tab-contents currents" id="tabs-1">
        @include('scripts.messages')
        {{Form::open(array('url' => 'messages/action', 'name' => 'messages'))}}
        <div class="b-message-ls__left">
            <div class="b-message-ls-button">
                <input type="button" class="b-message-ls-button__item" value="Новое сообщение" onclick="message.update('new');">
            </div>
            <div class="b-message-ls-list">
                <ul>
                    <li class="b-message-ls-list__list"><a href="#" data-page="contacts">Контакты</a><span>0</span></li>
                    <li class="b-message-ls-list__list"><a href="#" data-page="inbox">Входящие</a><span>{{$new_messages->count()}}</span></li>
                    <li class="b-message-ls-list__list"><a href="#" data-page="outbox">Отправленные</a></li>
                    <li class="b-message-ls-list__list"><a href="#" data-page="blacklist">Черный список</a></li>
                    <li class="b-message-ls-list__list"><a href="#" data-page="trash">Удаленные</a></li>
                    <li class="clear"></li>
                </ul>
            </div>
        </div>
        <div class="b-message-ls__right" id="messages">
            @include('message.'.$subpage, array('messages' => $items))
        </div>
        <div class="clear"></div>
        {{Form::close()}}
    </div>
    <div class="b-message-friends tab-contents" id="tabs-2" >
        <div class="b-message-friends__left">
            @foreach($friend_requests as $friend)
            <?php $friend = User::find($friend->id); ?>
            <div class="b-message-friends-block">
                <div class="b-message-friends-block__left">
                    <div class="b-message-friends-block-image">
                        <img src="{{$friend->avatar()}}" alt="" class="b-message-friends-block-image__image">
                        <!--a href="{{URL::to('messages?page=new&receiver='.$friend->description->first_name.' '.$friend->description->last_name)}}">
                            <input type="button" value="Сообщение" class="b-message-friends-block-image__button btn-gray" >
                        </a-->
                    </div>
                </div>
                <div class="b-message-friends-block__right">
                    <div class="b-message-friends-info">
                        <div class="b-message-friends-info__name">{{$friend->description->first_name . ' ' . $friend->description->last_name }}</div>
                        <div class="b-message-friends-info__notification">Предлагает вам дружбу</div>
                        <div class="b-message-friends-info__counts">
                            <ul>
                                <li class="b-message-friends-info-counts__list">
                                    <span>{{$friend->friends()->count()}}</span>
                                    <span>Друзей</span>
                                </li>
                                <li class="b-message-friends-info-counts__list"><span>{{$friend->mutualFriends()->count()}}</span><span>общих друзей</span></li>
                                <li class="b-message-friends-info-counts__list">
                                    <img src="{{asset('img/110.png')}}" alt="">
                                    <span class="red-counter">{{$friend->publications()->count()}}</span>
                                </li>
                                <li class="b-message-friends-info-counts__list">
                                    <img src="{{asset('img/111.png')}}" alt="">
                                    <span class="red-counter">{{$friend->canPublishBlogs()->count()}}</span>
                                </li>
                                <li class="b-message-friends-info-counts__list">
                                    <img src="{{asset('img/112.png')}}" alt="">
                                    <span class="red-counter">{{$friend->photos()->count()}}</span>
                                </li>
                                <!--li class="b-message-friends-info-counts__list">
                                    <img src="{{asset('img/114.png')}}" alt="">
                                    <span class="red-counter">999</span>
                                </li-->
                                <div class="clear"></div>
                            </ul>
                        </div>
                        <div class="b-message-friends-info-button">
                            <a  href="{{ URL::to('people/removeFriend'). '/' . $friend->id }}">
                            <input type="button" value="Отклонить" class="b-message-friends-info-button__button btn-gray">
                            </a>
                            <a  href="{{ URL::to('people/submitFriend'). '/' . $friend->id }}">
                            <input type="button" value="Принять" class="b-message-friends-info-button__button btn-gray">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            @endforeach
        </div>
        <div class="b-message-friends__right">
            <div class="b-message-friends-search">
                <div class="b-message-friends-search__title">Поиск друзей</div>
                <div class="b-message-friends-search-inner">
                    <ul>
                        <li class="b-message-friends-search-inner__list">
                            <div class="friend-search-group">
                                <input type="text" value="Поиск людей" class="friend-input">
                                <input type="submit" class="friend-button">
                            </div>

                        </li>
                        <li class="b-message-friends-search-inner__list">
                            <div class="search-title">Место поска</div>
                            <div class="select-group">
                                <select name="" id="" class="select-default select-country" data-placeholder="Страна">
                                    <option value="">Страна</option>
                                </select>
                            </div>
                            <div class="select-group select">
                                <select name="" id="" class="select-default select-country" data-placeholder="Город">
                                    <option value="">Город</option>
                                </select>
                            </div>
                            <div class="select-group">
                                <input type="text" value="Нет в списке" class="noinlist"></div>
                        </li>
                        <li class="b-message-friends-search-inner__list">
                            <div class="search-title">Учебные заведения</div>
                            <div class="input-group">
                                <input type="text" value="Школа, ВУЗ" class="school-field">
                            </div>
                        </li>
                        <li class="b-message-friends-search-inner__list">
                            <div class="search-title">Пол</div>
                            <div class="select-group">
                                <ul>
                                    <li class="select-male__list"><a href="">Мужской</a></li>
                                    <li class="select-male__list"><a href="">Женский</a></li>
                                    <li class="select-male__list"><a href="">Любой</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="b-message-friends-search-inner__list">
                            <div class="search-title">Возраст</div>
                            <div class="select-group">
                                <select name="" id="" class="select-default select-age" data-placeholder="От">
                                    <option value=""></option>
                                </select>
                                <span>-</span>
                                <select name="" id="" class="select-default select-age" data-placeholder="До">
                                    <option value="">До</option>
                                </select>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
        <div class="clear"></div>
    </div>
</div>