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
				<div class="b-profile-middle-list">
					<ul>
						<li class="b-profile-middle-list__left">
							@if($user->description->age())
							<p class="b-profile-middle-list__item">День рождения</p>
							@endif
							@if($user->description->getLiveplace())
							<p class="b-profile-middle-list__item">Живет:</p>
							@endif
							@if($user->description->getBirthplace())
							<p class="b-profile-middle-list__item">Родился:</p>
							@endif
						</li>
						<li class="b-profile-middle-list__right">
							@if($user->description->age())
								<p class="b-profile-middle-list__item">{{Date::parse($user->description->birthday)->format('j F Y')}}</p>
								@endif
								@if($user->description->getLiveplace())
								<p class="b-profile-middle-list__item">{{$user->description->getLiveplace()}}</p>
								@endif
								@if($user->description->getBirthplace())
								<p class="b-profile-middle-list__item">{{$user->description->getBirthplace()}}</p>
								@endif
						</li>
						<div class="clear"></div>
					</ul>
				</div>
				<div class="b-profile-middle-info">
					<button type="button" class="b-profile-middle-info__button" data-toggle="modal" data-target=".bs-example-modal-sm">показать полную информацию</button>
					<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					
						 <div class="modal-dialog modal-lg">
							<div class="modal-content">

								<div class="b-profile-title">Полная информация</div>
								<div class="b-profile__left">
									<div class="b-profile-photo">
										<div class="b-profile-photo__image">
											<a href="{{asset($user->avatar())}}" class="user-image">
												<img src="{{asset($user->avatar())}}" style="width: 244px; height: 244px;" />
											</a>
										</div>
									<script>
										$(document).ready(function(){
											$('.b-user-profile .b-user-profile__left').photobox('a', {thumbs: false, autoplayBtn: false,});
										});
									</script>
									</div>
								</div>
								<div class="b-profile__right">
									<div class="b-profile-top">
										<div class="b-profile-top-information">
											<div class="b-profile-top-information__top"><span class="raiting-text">Рейтинг:</span><span class="raiting-num">+{{$user->rating}}</span></div>
											<div class="b-profile-top-information__name">{{$user->getNames()}}</div>
										<!--    <div class="b-profile-top-information__status"></div> -->
										</div>			
									</div>
									<div class="b-profile-middle">
									<div class="b-profile-middle-wrapper">
										<div class="b-profile-middle-wrapper__inner">
												 <div class="b-profile-middle-title">
													<div class="b-profile-middle-title__title">
														Основная информация
													</div>
										<div class="b-profile-middle-title__button">
											<a href="{{URL::to('profile/edit/main')}}" >Изменить</a>
											<a href="" class="btn btn-disappear"></a>
										</div>
													<div class="clear"></div>
												</div>
												<div class="b-profile-middle-list">
													<ul>
													<li class="b-profile-middle-list__left">
														@if($user->description->age())
														<p class="b-profile-middle-list__item">День рождения</p>
														@endif
														@if(isset($gender) && $user->description->checkAccess('gender_access'))
														<p class="b-profile-middle-list__item">Пол:</p>
														@endif
														@if($user->description->getLiveplace())
														<p class="b-profile-middle-list__item">Живет:</p>
														@endif
														@if($user->description->getBirthplace())
														<p class="b-profile-middle-list__item">Родился:</p>
														@endif
													</li>
												<li class="b-profile-middle-list__right">
													@if($user->description->age())
													<p class="b-profile-middle-list__item">{{Date::parse($user->description->birthday)->format('j F Y')}}</p>
													@endif
													@if(isset($gender) && $user->description->checkAccess('gender_access'))
													<p class="b-profile-middle-list__item">{{$gender}}</p>
													@endif
													@if($user->description->getLiveplace())
													<p class="b-profile-middle-list__item">{{$user->description->getLiveplace()}}</p>
													@endif
													@if($user->description->getBirthplace())
													<p class="b-profile-middle-list__item">{{$user->description->getBirthplace()}}</p>
													@endif
													</li>
													<div class="clear"></div>
													</ul>
												</div>
										</div>
										<div class="b-profile-middle-wrapper__inner">
												 <div class="b-profile-middle-title">
													<div class="b-profile-middle-title__title">
														Контакты
															</div>
											<div class="b-profile-middle-title__button">
												<a href="{{URL::to('profile/edit/contact')}}" >Изменить</a>
												<a href="" class="btn btn-disappear"></a>
											</div>
													<div class="clear"></div>
												</div>
												<div class="b-profile-middle-list">
													<?php $contacts = $user->getProfileItems('contact');
														if($contacts):
													?>
													<ul>
													<li class="b-profile-middle-list__left">
															@foreach($contacts as $contact)
														<p class="b-profile-middle-list__item">{{trans('profile.contacts')[$contact->subtype]}}</p>
													@endforeach
													</li>
													<li class="b-profile-middle-list__right">
														@foreach($contacts as $contact)
															<p class="b-profile-middle-list__item">{{$contact->value}}</p>
														@endforeach
													</li>
													<div class="clear"></div>
													</ul>
													<?php
														endif
													?>
												</div>
										</div>
										<div class="b-profile-middle-wrapper__inner">
												 <div class="b-profile-middle-title">
													<div class="b-profile-middle-title__title">
														Образование
																										</div>
										<div class="b-profile-middle-title__button">
											<a href="{{URL::to('profile/edit/study')}}"  >Изменить</a>
											<a href="" class="btn btn-disappear"></a>
										</div>
													<div class="clear"></div>
												</div>
										<div class="b-profile-middle-list" style="width: 400px;">
											<?php
											$studies = $user->getProfileItems('study');
											if ($studies):
												?>
												<ul>
													<li class="b-profile-middle-list__left">
														@foreach($studies as $study)
															<p class="b-profile-middle-list__item">{{trans('profile.study')[$study->subtype]}}</p>
															@if($study->subtype == 'university')
																<p class="b-profile-middle-list__item">Специальность</p>
															@endif
														@endforeach
													</li>
													<li class="b-profile-middle-list__right">
														@foreach($studies as $study)
															<p class="b-profile-middle-list__item">{{$study->value}} ({{Date::parse($study->date_begin)->format('Y').' - '.Date::parse($study->date_end)->format('Y')}})</p>
															@if($study->subtype == 'university')
																<p class="b-profile-middle-list__item">{{($study->meta_1)?$study->meta_1:'-'}}</p>
															@endif
														@endforeach
													</li>
													<div class="clear"></div>
												</ul>
												<?php
											endif
											?>
												</div>
										</div>
										<div class="b-profile-middle-wrapper__inner">
												 <div class="b-profile-middle-title">
													<div class="b-profile-middle-title__title">
														Работа
																										</div>
							<div class="b-profile-middle-title__button">
								<a href="{{URL::to('profile/edit/job')}}"  >Изменить</a>
								<a href="" class="btn btn-disappear"></a>
							</div>
													<div class="clear"></div>
												</div>
							<div class="b-profile-middle-list">
								<?php
								$jobs = $user->getProfileItems('job');
								if ($jobs):
									?>
									<ul>
										<li class="b-profile-middle-list__left">
											@foreach($jobs as $job)
											<p class="b-profile-middle-list__item">Компания</p>
											<p class="b-profile-middle-list__item">Должность</p>
											<p class="b-profile-middle-list__item">Дополнительно</p>
											@endforeach
										</li>
										<li class="b-profile-middle-list__right">
											@foreach($jobs as $job)
											<p class="b-profile-middle-list__item">{{$job->value}}</p>
											<p class="b-profile-middle-list__item">{{($job->meta_1)?$job->meta_1:'-'}}</p>
											<p class="b-profile-middle-list__item">{{($job->description)?$job->description:'-'}}</p>
											@endforeach
										</li>
										<div class="clear"></div>
									</ul>
									<?php
								endif
								?>
												</div>
										</div>
										<div class="b-profile-middle-wrapper__inner">
												 <div class="b-profile-middle-title">
													<div class="b-profile-middle-title__title">
														Семья
													</div>
									<div class="b-profile-middle-title__button">
										<a href="{{URL::to('profile/edit/family')}}"  >Изменить</a>
										<a href="" class="btn btn-disappear"></a>
									</div>
													<div class="clear"></div>
												</div>
											<div class="b-profile-middle-list">
												<?php $members = $user->getProfileItems('family'); ?>
													<ul>
													<li class="b-profile-middle-list__left">
														@if($user->description->marital_status)
														<p class="b-profile-middle-list__item">Семейное положение:</p>
														@endif
															@foreach($members as $member)
														<p class="b-profile-middle-list__item">{{trans('profile.family')[$member->subtype]}}</p>
															@endforeach
													</li>
														<li class="b-profile-middle-list__right">
														@if($user->description->marital_status)
														<p class="b-profile-middle-list__item">{{$maritalStatus}}</p>
														@endif
														@foreach($members as $member)
														<p class="b-profile-middle-list__item">{{$member->value}}</p>
														@endforeach
													</li>
													<div class="clear"></div>
													</ul>
												</div>
												</div>
												<div class="b-profile-middle-wrapper__inner">
													<div class="b-profile-middle-title">
														<div class="b-profile-middle-title__title">
															Дополнительно
														</div>
														<div class="b-profile-middle-title__button">
															<a href="{{URL::to('profile/edit/additional')}}"  >Изменить</a>
															<a href="" class="btn btn-disappear"></a>
														</div>
														<div class="clear"></div>
													</div>
													<div class="b-profile-middle-list">
														<?php
														$passions = $user->getProfileItems('passion');
														$nicknames = $user->getProfileItems('nickname');
															?>
															<ul>
																<li class="b-profile-middle-list__left">
																	@if($passions->count() > 0)
																	<p class="b-profile-middle-list__item">Увлечения:</p>
																	@endif
																	@if($user->description->about_me)
																	<p class="b-profile-middle-list__item">О себе:</p>
																	@endif
																	@if($nicknames->count() > 0)
																	<p class="b-profile-middle-list__item">Другие имена, прозвища:</p>
																	@endif
																</li>
																<li class="b-profile-middle-list__right">
																	@if($passions->count() > 0)
																	<p class="b-profile-middle-list__item">@foreach($passions as $passion) {{$passion->value}}, @endforeach</p>
																	@endif
																	@if($user->description->about_me)
																	<p class="b-profile-middle-list__item">{{($user->description->about_me)?$user->description->about_me:'-'}}</p>
																	@endif
																	@if($nicknames->count() > 0)
																	<p class="b-profile-middle-list__item">@foreach($nicknames as $nickname) {{$nickname->value}}, @endforeach</p>
																	@endif
																</li>
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
					</div>
				</div>


			</div>
			<div class="clear"></div>

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

<ol id="outline">

  	<li data-class="b-profile-top-button__button" data-options="tipLocation:top;tipAnimation:fade" data-button="Далее:создать топик">
	<p>Посмотрите случайные профили.</p>
	</li>

  	<li data-class="topic-icon" data-button="Закрыть">
	<p>Создайте топик</p>
	</li>

</ol>

<script>
 $(window).load(function(){
	console.log('started');
	$("#outline").joyride({
		'tipLocation': 'bottom',         // 'top' or 'bottom' in relation to parent
		'nubPosition': 'auto',           // override on a per tooltip bases
		'scrollSpeed': 300               // Page scrolling speed in ms
	});
 })
</script>


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
@section('styles')
	<link rel="stylesheet" href="{{ asset('css/joyride-2.1.css') }}">
@stop

@section('scripts')

  <script src="{{ asset('js/jquery.joyride-2.1.js') }}"></script>
@stop
