@extends('misc.layout')

@section('content')
<div class="b-content">
	<div class="b-profile">
		<div class="b-profile__left">
			<div class="b-profile-photo">
                                <div class="b-profile-photo__image">
                                    @include('profile.edit.set-avatar', array('reloadConfirm' => true))
				</div>
                            <a href="" class="b-profile-photo__button" onclick="javascript: $('div.avatar-view.user-image').click(); return false;">Загрузить фото</a>

			</div>
		</div>
		<div class="b-profile__right">
			<div class="b-profile-top">
				<div class="b-profile-top__left">
					<div class="b-profile-top-information">
						<div class="b-profile-top-information__top"><span class="raiting-text">Рейтинг:</span><span class="raiting-num">+{{$user->rating}}</span></div>
						<div class="b-profile-top-information__name">{{$user->getNames()}}</div>
						<div class="b-profile-top-information__status"></div>
					</div>

				</div>

				<div class="b-profile-top__right">
					<div class="b-profile-top-button">
						<a href="{{URL::to('profile/random')}}" class="b-profile-top-button__button">Случайный профиль</a>
						
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="b-profile-middle">

				<ul>
				
					<div class="clear"></div>
				</ul>
				<div class="b-profile-middle__button">Показать полную информацию</div>
			</div>
			<div class="b-profile-counters">
				<ul>
                                            @if($friends->count() > 0)
                                                <li>
                                                    <a href="{{URL::to('profile/'.$user->id.'/friends')}}">
                                                        <p>{{$friends->count()}}</p>
                                                        <p>Друзей</p>
                                                    </a>
                                                </li>
                                            @endif
                                            @if($user->id != Auth::id() && $mutualFriends->count() > 0)
                                                <li><a href="{{URL::to('profile/'.$user->id.'/mutualFriends')}}">
                                                        <p>{{$mutualFriends->count()}}</p>
                                                        <p>Общих</p>
                                                </a></li>
                                            @endif
                                            @if($subscribers->count() > 0)
                                            <li><a href="{{URL::to('profile/'.$user->id.'/subscribers')}}">
                                                <p>{{$subscribers->count()}}</p>
							<p>Подписчиков</p>
                                            </a></li>
                                        @endif
                                        @if($photos->count() > 0)
                                        <li><a href="{{URL::to('profile/'.$user->id.'/photos')}}">
                                                <p>{{$photos->count()}}</p>
							<p>Фотографии</p>
                                            </a></li>
                                        @endif
                                        @if($videos->count() > 0)
                                        <li><a href="{{URL::to('profile/'.$user->id.'/videos')}}">
                                                <p>{{$videos->count()}}</p>
							<p>Видео</p>
                                            </a></li>
                                        @endif
					<div class="clear"></div>
				</ul>
			</div>
		</div>
		<div class="clear"></div>
		
	</div>
	<div class="b-user-navigation">
		<div class="b-user-navigation-list">
			<ul class="tabs">
                            <li class="b-user-navigation-list__list tab-link current" data-tab="tab-1" ><a href="{{URL::to('profile')}}">Лента</a></li>
                            <li class="b-user-navigation-list__list" data-tab="tab-2"><a href="{{URL::to('profile/messages')}}">Сообщения</a>@if(count(@$new_messages))<span>{{count($new_messages)}}</span>@endif</li>
                            <li class="b-user-navigation-list__list" data-tab="tab-4"><a href="{{URL::to('profile/publications')}}">Публикации</a><span>{{$user->publications(10000)->count()}}</span></li>
                            <li class="b-user-navigation-list__list" data-tab="tab-3"><a href="{{URL::to('profile/friends')}}">Друзья</a><span>{{$user->friends()->count()}}</span></li>
				<li class="b-user-navigation-list__list"><a href="{{URL::to('profile/subscribtions')}}">Подписано</a></li>
                                <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/favourites')}}">Избранное</a><span>{{$user->favourites()->count()}}</span></li>
				<li class="b-user-navigation-list__list"><a href="{{URL::to('profile/edit/main')}}">Настройки</a></li>
				<div class="clear"></div>
			</ul>
		</div>
	</div>

    @include('profile.show.body', compact('items', 'page'))
	<div class="b-publication tab-content nocurrent " id="tab-1">
		<div class="b-publication-sort b-user-wall">
			<ul>
				<li class="b-publication-sort__list">Сортировать:</li>
				<li class="b-publication-sort__list"><a href="">Топики</a></li>
				<li class="b-publication-sort__list"><a href="">Блоги</a></li>
				<li class="b-publication-sort__list"><a href="">Группы</a></li>
				<li class="b-publication-sort__list"><a href="">Все</a></li>
				<div class="clear"></div>
			</ul>


		</div>
	</div>
	<div class="b-friends tab-content" id="tab-4" class="tab-content">

		<div class="b-friends-sort">
			<div class="b-friends-sort__left">			
				<span class="b-friends-sort__text">Сортировать</span>
				<div class="b-friends-sort__sort">
					<a href="#" class="button-select">Все</a>
					<div class="b-friends-sort-list dropdown">
						<ul class="dropdown">
							<li class="b-friends-sort-list__list">Семья <span>0</span><a href=""></a></li>
							<li class="b-friends-sort-list__list">Лучшие друзья <span>0</span><a href=""></a></li>
							<li class="b-friends-sort-list__list">Коллеги <span>0</span><a href=""></a></li>
							<li class="b-friends-sort-list__list">Знакомые <span>0</span><a href=""></a></li>
							<li class="b-friends-sort-list__list">Все <span>0</span><a href=""></a></li>
							<li class="b-friends-sort-list__list">Добавить категорию <a href=""></a></li>
							
						</ul>
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
			$i =1;
			while($i<=4) {
		?>
				<div class="b-friends-block">
			<div class="b-friends-block__left">
				<div class="b-friends-block-image">
					<img src="{{ asset('img/106.png') }} " alt="" class="b-friends-block-image__image">
					<a href="#" class="b-friends-block-image__button ">Сообщение</a>
				</div>
			</div>
			<div class="b-friends-block__right">
				<div class="b-friends-block-info">
					<div class="b-friends-block-info__name">Бобровский <p>Сергей</p></div>
					<div class="b-friends-block-info__amount">2322 друзей</div>
					<div class="b-friends-block-info__counter">
						<ul class="b-friends-block-info-counters-list">
							<li class="b-friends-block-info-counters-list__list">
								<img src="{{asset('img/110.png') }}" alt=""><span>999</span>
							</li>
							<li class="b-friends-block-info-counters-list__list">
								<img src="{{asset('img/111.png') }}" alt=""><span>999</span></li>
							<li class="b-friends-block-info-counters-list__list">
								<img src="{{asset('img/112.png') }}" alt=""><span>999</span>
							</li>
							<li class="b-friends-block-info-counters-list__list">
								<img src="{{asset('img/114.png') }}" alt=""><span>999</span>
							</li>
							<div class="clear"></div>
						</ul>
					</div>
					<div class="b-friends-block-info__edit">
					<a href="" class="button-select ">Редактировать</a>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<?php 
  		 $i=$i+1;
    		 }

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
							<li class="b-friends-common-list__list"><a href=""><img src="{{asset('img/59.png') }}" alt=""></a></li>
							<li class="b-friends-common-list__list"><a href=""><img src="{{asset('img/59.png') }}" alt=""></a></li>
							<li class="b-friends-common-list__list"><a href=""><img src="{{asset('img/59.png') }}" alt=""></a></li>
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
							<li class="b-friends-common-list__list"><a href=""><img src="{{asset('img/59.png') }}" alt=""></a></li>
							<li class="b-friends-common-list__list"><a href=""><img src="{{asset('img/59.png') }}" alt=""></a></li>
							<li class="b-friends-common-list__list"><a href=""><img src="{{asset('img/59.png') }}" alt=""></a></li>
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
	<div class="b-message tab-content" id="tab-3">
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
						<li class="b-message-ls-list__list"><a href="">Входящие</a><span>6</span></li>
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
							<div class="b-message-ls-mark-button-list dropdown">
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
						<tr>
							<td>
								<ul>
									<li class="b-message-ls-mark__list b-message-ls-mark__list_second">
										<div class="b-message-ls-mark__checkbox b-message-ls-mark__checkbox_second">
											<input type="checkbox">
										</div>
									</li>
									<li class="b-message-ls-mark__list">
										<div class="b-message-ls-mark__image">
											<img src="{{asset('img/118.png')}}" alt="">
										</div>
									</li>
									<li class="b-message-ls-mark__list">
									<div class="b-message-ls-mark-desc">
										<div class="b-message-ls-mark-desc__title">Привет как дела! Дамир заголовок оканчиваеться троечием до ...</div>
										<div class="b-message-ls-mark-desc__name">Имя пользователя</div>
									</div>	
									</li>
									<li class="b-message-ls-mark__list">
										<div class="b-message-ls-mark-num">
										<div class="b-message-ls-mark-num__image"><img src="{{asset('img/119.png')}}" alt=""></div>
										<span>12 
										декабря</span>
										</div>
									</li>
									
								</ul>
							</td>

						</tr>
						

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
</div>
@stop
<?php /*
<div class="b-content">
	<div class="b-user-profile">
		<div class="b-user-profile__left">
			@include('profile.edit.set-avatar', array('reloadConfirm' => true))
		</div>

		<div class="b-user-profile__middle">
			@include('profile.show.info', compact('user', 'gender', 'marital_status'))
		</div>
		<div class="b-user-profile__right">
			<div class="b-user-profile-link"><a href="#" class="b-user-profile-link__create">{{ trans('network.create') }}</a></div>
			<ul class="b-user-profile-links">
				<li class="b-user-profile-links__list"><a href="{{URL::to('topic/create')}}"></a></li>
				<li class="b-user-profile-links__list"><a href="{{URL::to('blog/create')}}"></a></li>
				<li class="b-user-profile-links__list"><a href="{{URL::to('photoalbum/create')}}"></a></li>
				<!--li class="b-user-profile-links__list"><a href="#"></a></li>
				<li class="b-user-profile-links__list"><a href="#"></a></li>
				<li class="b-user-profile-links__list"><a href="#"></a></li>
				<li class="b-user-profile-links__list"><a href="#"></a></li-->
				<div class="clear"></div>
			</ul>
			<ul class="b-user-profile-buttons">
				<li class="b-user-profile-buttons__list"><a href="{{URL::to('messages/new')}}">{{ trans('network.send-message') }}<span class="msg-image"></span></a></li>
				<li class="b-user-profile-buttons__list"><a href="{{URL::to('search/people')}}">{{ trans('network.search-friends') }}<span class="search-image"></span></a></li>
				<li class="b-user-profile-buttons__list"><a href="#">{{ trans('network.system-messages') }}<span class="system-image"></span></a></li>
				<li class="b-user-profile-buttons__list"><a href="{{URL::to('profile/random')}}">{{ trans('network.random-profile') }}<span class="random-image"></span></a></li>
			</ul>
		</div>
		<div class="clear"></div>
	</div>
	<div class="b-user-navigation">
		<ul class="b-user-navigation-list">
			<li class="b-user-navigation-list__list"><a href="{{URL::to('profile/newsline')}}">{{ trans('network.timeline') }}</a></li>
			<li class="b-user-navigation-list__list"><a href="{{URL::to('profile/publications')}}">{{ trans('network.publications') }}</a><span>{{$user->publications(10000)->count()}}</span></li>
			<li class="b-user-navigation-list__list"><a href="{{URL::to('profile/friends')}}">{{ trans('network.friends') }}</a><span>{{$user->friends()->count()}}</span></li>
			<li class="b-user-navigation-list__list"><a href="{{URL::to('profile/subscriptions')}}">{{ trans('network.subscriptions') }}</a></li>
			<li class="b-user-navigation-list__list"><a href="{{URL::to('profile/favourites')}}">{{ trans('network.favourites') }}</a><span>{{$user->favourites()->count()}}</span></li>
			<a href="{{URL::to('profile/edit/main')}}" class="b-user-navigation-list__setting">{{ trans('network.settings') }}</a>
			<div class="clear"></div>
		</ul>
	</div>
	
	@include('profile.show.body', compact('items', 'page'))
	
		<div class="clear"></div>
	</div>
</div>

</div>
@stop

*/?>