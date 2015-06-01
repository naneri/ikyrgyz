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
        <div class="b-message-ls__left">
            <div class="b-message-ls-button">
                <input type="submit" class="b-message-ls-button__item" value="Новое сообщение">
            </div>
            <div class="b-message-ls-list">
                <ul>
                    <li class="b-message-ls-list__list"><a href="">Контакты</a><span>0</span></li>
                    <li class="b-message-ls-list__list"><a href="">Входящие</a><span>{{$new_messages->count()}}</span></li>
                    <li class="b-message-ls-list__list"><a href="">Отправленные</a></li>
                    <li class="b-message-ls-list__list"><a href="">Черный список</a></li>
                    <li class="b-message-ls-list__list"><a href="">Удаленные</a></li>
                    <li class="clear"></li>
                </ul>
            </div>
        </div>
        <div class="b-message-ls__right">
            <div class="b-message-ls-mark">
                <table>
                    <tr>
                        <td>
                            <ul>
                                <li class="b-message-ls-mark__list">
                                    <div class="b-message-ls-mark__checkbox">
                                        <input type="checkbox" >
                                    </div>
                                </li>
                                <li class="b-message-ls-mark__list b-message-ls-mark__list_border-right">
                                    <div class="b-message-ls-mark-button">
                                        <a href="#" class="b-message-ls-mark-button__item button-select">Прочитанное</a>
                                        <div class="b-message-ls-mark-button-list dropdown-list">
                                            <ul>
                                                <li class="b-message-ls-mark-button-list__item"><a href="">Все прочитанны</a></li>
                                                <li class="b-message-ls-mark-button-list__item"><a href="">Все непрочитанны</a></li>
                                                <li class="b-message-ls-mark-button-list__item"><a href="">Черный список</a></li>
                                                <li class="b-message-ls-mark-button-list__item"><a href="">Удаленные</a></li>
                                            </ul>
                                        </div>
                                        <input type="submit" class="b-message-ls-mark-button__item button-make" value="Выполнить">
                                    </div>
                                </li>
                                <li class="b-message-ls-mark__list b-message-ls-mark__list_sort">
                                    <a href="">Все</a>
                                    <a href="">Друзья</a>
                                    <a href="">Группы</a>
                                    <a href="">События</a>
                                </li>
                                <li class="b-message-ls-mark__list b-message-ls-mark__list_last">
                                    <a href=""><img src="{{asset('img/refresh-icon.png')}}" alt=""></a>
                                </li>
                                <div class="clear"></div>
                            </ul>
                        </td>

                    </tr>
                    @foreach($items as $message)
                    <tr>
                        <td>
                            <ul>
                                <li class="b-message-ls-mark__list b-message-ls-mark__list_second">
                                    <div class="b-message-ls-mark__checkbox b-message-ls-mark__checkbox_second">
                                        {{Form::checkbox('messages[]', $message->id)}}
                                    </div>
                                </li>
                                <li class="b-message-ls-mark__list">
                                    <div class="b-message-ls-mark__image">
                                        <img style="width: 50px;height:50px;" src="{{($message->sender_id == Auth::id())?$message->receiver->avatar():$message->sender->avatar()}}" alt="">
                                    </div>
                                </li>
                                <li class="b-message-ls-mark__list">
                                    <div class="b-message-ls-mark-desc">
                                        <a href="{{URL::to('message/show/' . $message->id)}}">
                                            <div class="b-message-ls-mark-desc__title">{{mb_substr(strip_tags($message->text), 0, 200, 'UTF-8') }}</div>
                                        </a>
                                        <div class="b-message-ls-mark-desc__name">
                                            {{($message->sender_id == Auth::id())?$message->receiver->getNames():$message->sender->getNames()}}</div>
                                    </div>	
                                </li>
                                <li class="b-message-ls-mark__list">
                                    <div class="b-message-ls-mark-num">
                                        <div class="b-message-ls-mark-num__image" style="height: auto;"><img src="{{asset('img/119.png')}}" alt=""></div>
                                        <span>{{date_format($message->created_at, 'd M')}}</span>
                                    </div>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="b-message-friends tab-contents" id="tabs-2" >
        <div class="b-message-friends__left">
            <div class="b-message-friends-block">
                <div class="b-message-friends-block__left">
                    <div class="b-message-friends-block-image">
                        <img src="{{asset('img/107.png')}}" alt="" class="b-message-friends-block-image__image">
                        <input type="submit" value="Сообщение" class="b-message-friends-block-image__button btn-gray" >
                    </div>
                </div>
                <div class="b-message-friends-block__right">
                    <div class="b-message-friends-info">
                        <div class="b-message-friends-info__name">Бобровский Сергей</div>
                        <div class="b-message-friends-info__notification">Предлагает вам дружбу</div>
                        <div class="b-message-friends-info__counts">
                            <ul>
                                <li class="b-message-friends-info-counts__list">
                                    <span>58</span>
                                    <span>Друзей</span>
                                </li>
                                <li class="b-message-friends-info-counts__list"><span>8</span><span>друзей</span></li>
                                <li class="b-message-friends-info-counts__list">
                                    <img src="{{asset('img/110.png')}}" alt="">
                                    <span class="red-counter">999</span>
                                </li>
                                <li class="b-message-friends-info-counts__list">
                                    <img src="{{asset('img/111.png')}}" alt="">
                                    <span class="red-counter">999</span>
                                </li>
                                <li class="b-message-friends-info-counts__list">
                                    <img src="{{asset('img/112.png')}}" alt="">
                                    <span class="red-counter">999</span>
                                </li>
                                <li class="b-message-friends-info-counts__list">
                                    <img src="{{asset('img/114.png')}}" alt="">
                                    <span class="red-counter">999</span>
                                </li>
                                <div class="clear"></div>
                            </ul>
                        </div>
                        <div class="b-message-friends-info-button">
                            <input type="submit" value="Отклонить" class="b-message-friends-info-button__button btn-gray">
                            <input type="submit" value="Принять" class="b-message-friends-info-button__button btn-gray">
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
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