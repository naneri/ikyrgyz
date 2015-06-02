<div class="b-friends tab-content current" id="tab-4" class="tab-content">

    <div class="b-friends-sort">
        <div class="b-friends-sort__left">			
            <span class="b-friends-sort__text">Сортировать</span>
            <div class="b-friends-sort__sort">
                <a href="#" class="button-select">Все</a>
                <div class="b-friends-sort-list dropdown-list">
                    <ul>
                        <li class="b-friends-sort-list__list"><a href="">Семья <span>0</span></a></li>
                        <li class="b-friends-sort-list__list"><a href="">Лучшие друзья <span>0</span></a></li>
                        <li class="b-friends-sort-list__list"><a href="">Коллеги <span>0</span></a></li>
                        <li class="b-friends-sort-list__list"><a href="">Знакомые <span>0</span></a></li>
                        <li class="b-friends-sort-list__list"><a href="">Все <span>0</span></a></li>
                        <li class="b-friends-sort-list__list b-friends-sort-list__list_modal"> <a href="#">Добавить категорию</a></li>

                    </ul>

                </div>
                <div class="js-simple-modal">
                    <div class="b-friends-category">
                        <div class="b-friends-category__title">Добавить категорию друзей</div>
                        <div class="b-friends-category__new">
                            <input type="text" value="Введите новую категорию" class="simple-input">
                        </div>
                        <div class="b-friends-category__button">
                            <input type="button" value="Отмена" class="cancel-button"><input type="button" value="Добавить" class="submit-button">
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="b-friends-sort__right">
            <span class="b-friends-sort__text">
                Заблокированные
            </span>
        </div>
        <div class="clear"></div>

    </div>
    <div class="b-friends-inner">

        <div class="b-friends-inner__left">
            <?php
            $i = 1;
            //while ($i <= 4) {
            ?>
            @foreach($items as $friend)
            <div class="b-friends-block">
                <div class="b-friends-block__left">
                    <div class="b-friends-block-image">
                        <img src="{{asset(($friend->user_profile_avatar) ? $friend->user_profile_avatar : asset('img/106.png'))}} " alt="" class="b-friends-block-image__image">
                        <a href="{{URL::to('messages/new?receiver='.$friend->first_name.'+'.$friend->last_name)}}" class="b-friends-block-image__button ">Сообщение</a>
                    </div>
                </div>
                <div class="b-friends-block__right">
                    <div class="b-friends-block-info"><a href="{{URL::to('profile/'.$friend->id)}}">
                            <div class="b-friends-block-info__name">{{$friend->first_name}} <p>{{$friend->last_name}}</p></div></a>
                        <div class="b-friends-block-info__amount">{{$friend->friends()->count()}} друзей</div>
                        <div class="b-friends-block-info__counter">
                            <ul class="b-friends-block-info-counters-list">
                                <li class="b-friends-block-info-counters-list__list">
                                    <img src="{{asset('img/110.png') }}" alt=""><span>{{$friend->publications()->count()}}</span>
                                </li>
                                <li class="b-friends-block-info-counters-list__list">
                                    <img src="{{asset('img/111.png') }}" alt=""><span>{{$friend->canPublishBlogs()->count()}}</span></li>
                                <li class="b-friends-block-info-counters-list__list">
                                    <img src="{{asset('img/112.png') }}" alt=""><span>{{$friend->photos()->count()}}</span>
                                </li>
                                <!--li class="b-friends-block-info-counters-list__list">
                                        <img src="{{asset('img/114.png') }}" alt=""><span>999</span>
                                </li-->
                                <div class="clear"></div>
                            </ul>
                        </div>
                        <div class="b-friends-block-info__edit">
                            <a href="" class="button-select ">Редактировать</a>
                            <div class="b-friends-block-info-list dropdown-list">
                                <ul>
                                    <li class="b-friends-block-info-list__list"><a href="">Семья <span>0</span></a></li>
                                    <li class="b-friends-block-info-list__list"><a href="">Лучшие друзья <span>0</span></a></li>
                                    <li class="b-friends-block-info-list__list"><a href="">Коллеги <span>0</span></a></li>
                                    <li class="b-friends-block-info-list__list"><a href="">Знакомые <span>0</span></a></li>
                                    <li class="b-friends-block-info-list__list"><a href="">Все <span>0</span></a></li>
                                    <li class="b-friends-block-info-list__list b-friends-block-info-list__list_modal"> <a href="">Добавить категорию</a></li>

                                </ul>

                            </div>
                            <div class="js-simple-modal">
                                <div class="b-friends-category">
                                    <div class="b-friends-category__title">Добавить категорию друзей</div>
                                    <div class="b-friends-category__new">
                                        <input type="text" value="Введите новую категорию" class="simple-input">
                                    </div>
                                    <div class="b-friends-category__button">
                                        <input type="button" value="Отмена" class="cancel-button"><input type="button" value="Добавить" class="submit-button">
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>

                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="b-friends-block">
                <div class="b-friends-block__left">
                    <div class="b-friends-block-image">
                        <img src="{{asset(($friend->user_profile_avatar) ? $friend->user_profile_avatar : asset('img/106.png'))}} " alt="" class="b-friends-block-image__image">
                        <a href="{{URL::to('messages/new?receiver='.$friend->first_name.'+'.$friend->last_name)}}" class="b-friends-block-image__button ">Сообщение</a>
                    </div>
                </div>
                <div class="b-friends-block__right">
                    <div class="b-friends-block-info"><a href="{{URL::to('profile/'.$friend->id)}}">
                            <div class="b-friends-block-info__name">{{$friend->first_name}} <p>{{$friend->last_name}}</p></div></a>
                        <div class="b-friends-block-info__amount">{{$friend->friends()->count()}} друзей</div>
                        <div class="b-friends-block-info__counter">
                            <ul class="b-friends-block-info-counters-list">
                                <li class="b-friends-block-info-counters-list__list">
                                    <img src="{{asset('img/110.png') }}" alt=""><span>{{$friend->publications()->count()}}</span>
                                </li>
                                <li class="b-friends-block-info-counters-list__list">
                                    <img src="{{asset('img/111.png') }}" alt=""><span>{{$friend->canPublishBlogs()->count()}}</span></li>
                                <li class="b-friends-block-info-counters-list__list">
                                    <img src="{{asset('img/112.png') }}" alt=""><span>{{$friend->photos()->count()}}</span>
                                </li>
                                <!--li class="b-friends-block-info-counters-list__list">
                                        <img src="{{asset('img/114.png') }}" alt=""><span>999</span>
                                </li-->
                                <div class="clear"></div>
                            </ul>
                        </div>
                        <div class="b-friends-block-info__edit">
                            <a href="" class="button-select ">Редактировать</a>
                            <div class="b-friends-block-info-list dropdown-list">
                                <ul>
                                    <li class="b-friends-block-info-list__list"><a href="">Семья <span>0</span></a></li>
                                    <li class="b-friends-block-info-list__list"><a href="">Лучшие друзья <span>0</span></a></li>
                                    <li class="b-friends-block-info-list__list"><a href="">Коллеги <span>0</span></a></li>
                                    <li class="b-friends-block-info-list__list"><a href="">Знакомые <span>0</span></a></li>
                                    <li class="b-friends-block-info-list__list"><a href="">Все <span>0</span></a></li>
                                    <li class="b-friends-block-info-list__list b-friends-block-info-list__list_modal"> <a href="">Добавить категорию</a></li>

                                </ul>

                            </div>
                            <div class="js-simple-modal">
                                <div class="b-friends-category">
                                    <div class="b-friends-category__title">Добавить категорию друзей</div>
                                    <div class="b-friends-category__new">
                                        <input type="text" value="Введите новую категорию" class="simple-input">
                                    </div>
                                    <div class="b-friends-category__button">
                                        <input type="button" value="Отмена" class="cancel-button"><input type="button" value="Добавить" class="submit-button">
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>

                    </div>
                </div>
                <div class="clear"></div>
            </div>
            @endforeach
            <?php
//                $i = $i + 1;
//            }
            ?>	
        </div>

        <div class="b-friends-inner__right">
            <div class="b-friends-common-wrapper">
                <div class="b-friends-common-wrapper__inner">
                    <div class="b-friends-common">
                        <div class="b-friends-common-top">
                            <div class="b-friends-common-top__title">Общие друзья <span>999</span></div>
                            <div class="b-friends-common-top__button">
                                <input type="submit" value="Все" class="button-all">
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="b-friends-common-list">
                            <ul>
                                @foreach((Auth::id() == $user->id)?Auth::user()->friendsOfFriends():$user->mutualFriends() as $friend)
                                <li class="b-friends-common-list__list"><a href="{{URL::to('profile/'.$friend->id)}}"><img src="{{asset($friend->avatar()) }}" alt=""></a></li>
                                @endforeach
                                <div class="clear"></div>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="b-friends-common-wrapper__inner">
                    <div class="b-friends-common">
                        <div class="b-friends-common-top">
                            <div class="b-friends-common-top__title">Возможно вы их знаете <span>999</span></div>
                            <div class="b-friends-common-top__button"><input type="submit" value="Все" class="button-all"></div>

                            <div class="clear"></div>
                        </div>
                        <div class="b-friends-common-list">
                            <ul>
                                @foreach(Auth::user()->recommendFriends() as $friend)
                                <li class="b-friends-common-list__list"><a href="{{URL::to('profile/'.$friend->id)}}"><img src="{{asset($friend->avatar()) }}" alt=""></a></li>
                                @endforeach
                                <div class="clear"></div>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>


        </div>
        <div class="clear"></div>
    </div>

</div>