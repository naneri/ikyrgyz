<div class="b-friends tab-content current" class="tab-content">
    <?php $isOwner = $user->id == Auth::id(); ?>
    <div class="b-friends-sort">
        <div class="b-friends-sort__left">			
            <span class="b-friends-sort__text">Сортировать</span>
            <div class="b-friends-sort__sort">
                <a onclick="friend.editCategory(this)" class="button-select">Все</a>
                <div class="b-friends-sort-list dropdown-list">
                    <ul>
                        @foreach($friendCategories as $category)
                            <li class="b-friends-sort-list__list"><a onclick="friend.filter('{{$category}}')">{{$category}} <span>{{$user->friendsOfCategory($category)->count()}}</span></a></li>
                        @endforeach
                        <li class="b-friends-sort-list__list"><a onclick="friend.filter('Все')">Все</a></li>
                        @if($isOwner)
                        <li class="b-friends-sort-list__list b-friends-sort-list__list_modal"> <a onclick="friend.addCategoryForm()">Добавить категорию</a></li>\
                        @else
                        <li class="b-friends-sort-list__list" style="display: none;"></li>
                        @endif
                    </ul>

                </div>
                @if($isOwner)
                <div class="js-simple-modal">
                    <div style="position: fixed; width: 100%; height: 100%; background-color: #000; top: 0; left: 0; opacity: 0.6; z-index: 95;"></div>
                    <div class="b-friends-category" style="z-index: 99;">
                        <div class="b-friends-category__title">Добавить категорию друзей</div>
                        <div class="b-friends-category__new">
                            <input type="text" placeholder="Введите новую категорию" class="simple-input">
                        </div>
                        <div class="b-friends-category__button">
                            <input type="button" value="Отмена" class="cancel-button" onclick="friend.addCategoryForm()"><input type="button" value="Добавить" class="submit-button" onclick="friend.submitAddCategory()">
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                @endif
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
            @foreach($items as $friend)
            <div class="b-friends-block" data-category="{{$friend->category}}">
                <div class="b-friends-block__left">
                    <div class="b-friends-block-image">
                        <img src="{{asset(($friend->user_profile_avatar) ? $friend->user_profile_avatar : asset('img/106.png'))}} " alt="" class="b-friends-block-image__image">
                        @if($isOwner)
                        <a href="{{URL::to('messages/new?receiver='.$friend->first_name.'+'.$friend->last_name)}}" class="b-friends-block-image__button ">Сообщение</a>
                        @endif
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
                        @if($isOwner)
                        <div class="b-friends-block-info__edit">
                            <a class="button-select" onclick="friend.editCategory(this)">{{($friend->category != '')?$friend->category:'Редактировать'}}</a>
                            <div class="b-friends-block-info-list dropdown-list">
                                <ul>
                                    @foreach($friendCategories as $category)
                                    <li class="b-friends-sort-list__list"><a onclick="friend.setCategory({{$friend->id}}, '{{$category}}')">{{$category}}<span></span></a></li>
                                    @endforeach
                                    <li class="b-friends-sort-list__list"> <a onclick="friend.remove({{$friend->id}})">Удалить из друзей</a></li>
                                </ul>
                            </div>
                        </div>
                        @endif
                        <div class="clear"></div>

                    </div>
                </div>
                <div class="clear"></div>
            </div>
            @endforeach
        </div>

        <div class="b-friends-inner__right">
            <div class="b-friends-common-wrapper">
                <div class="b-friends-common-wrapper__inner">
                    <div class="b-friends-common">
                        <div class="b-friends-common-top">
                            <?php $friendsOfFriends = (Auth::id() == $user->id) ? Auth::user()->friendsOfFriends() : $user->mutualFriends(); ?>
                            <div class="b-friends-common-top__title">{{(Auth::id() == $user->id) ?'Друзья друзей':'Общие друзья'}} <span>{{$friendsOfFriends->count()}}</span></div>
                            <div class="b-friends-common-top__button">
                                <input type="submit" value="Все" class="button-all">
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="b-friends-common-list">
                            <ul>
                                @foreach($friendsOfFriends->take(6) as $friend)
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
                            <div class="b-friends-common-top__title">Возможно вы их знаете <span></span></div>
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