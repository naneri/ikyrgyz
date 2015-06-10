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
						<div class="b-profile-top-information__top"><span class="raiting-text">Рейтинг:</span><span class="raiting-num" @if($user->rating<0) style="color: #d11;" @endif>{{(($user->rating>0)?'+':'').$user->rating}}</span></div>
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
			<ul class="">
                            <li class="b-user-navigation-list__list tab-link current" data-tab="tab-1" ><a href="{{URL::to('profile')}}">Лента</a></li>
                            <li class="b-user-navigation-list__list" data-tab="tab-2"><a href="{{URL::to('profile/messages')}}">Сообщения</a>@if(count(@$new_messages))<span>{{count($new_messages)}}</span>@endif</li>
                            <li class="b-user-navigation-list__list" data-tab="tab-4"><a href="{{URL::to('profile/publications')}}">Публикации</a><span>{{$user->publications(10000)->count()}}</span></li>
                            <li class="b-user-navigation-list__list" data-tab="tab-3"><a href="{{URL::to('profile/friends')}}">Друзья</a><span>{{$user->friends()->count()}}</span></li>
                            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/subscriptions')}}">Подписано</a><span>{{$user->subscriptions()->count()}}</span></li>
                                <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/favourites')}}">Избранное</a><span>{{$user->favourites()->count()}}</span></li>
				<li class="b-user-navigation-list__list"><a href="{{URL::to('profile/edit/main')}}">Настройки</a></li>
				<div class="clear"></div>
			</ul>
		</div>
	</div>

    @include('profile.show.body', compact('user', 'items', 'page'))
	<div class="b-publication tab-content">
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