@extends('misc.layout')

@section('content')
<div class="b-content">

<div class="b-profile">
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
			<div class="b-profile-middle-wrapper">
				<div class="b-profile-middle-wrapper__inner">
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
				<div class="b-profile-middle-info__item">
					Показать полную информацию
				</div>
				<div class="b-profile-middle-info-full">
					<div class="b-profile-middle-info-full-wrapper">
						<div class="b-profile-middle-info-full-wrapper__inner">
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
										<!-- 	<div class="b-profile-top-information__status"></div> -->
										</div>

								

			
			
								</div>
								<div class="b-profile-middle">
									<div class="b-profile-middle-wrapper">
										<div class="b-profile-middle-wrapper__inner">
											     <div class="b-profile-middle-title">
													<div class="b-profile-middle-title__title">
														Основная информация
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
			 <!--   <div class="b-profile-middle-button">
				<input type="submit" value="Закрыть" class="b-profile-middle-button__item">
			</div> -->

				</div>
				
			  
				
			  
				
			   
			</div>
		  
		   <!--  <ul>

				<li class="b-profile-middle__left">
					@if($user->description->age())
					<p>День рождения:</p>
					@endif
					@if($user->description->getLiveplace())
					<p>Живет:</p>
					@endif -->
				   <!--  <?php $jobs = $user->profileItemsGetValues('job'); ?> -->
			   <!--      @if(count($jobs) > 0)
					<p>Работает</p>
					@endif
					<div class="full-information">
						
					</div>
				</li>
				<li class="b-profile-middle__right">
					@if($user->description->age())
					<p>{{$user->description->birthday}}</p>
					@endif
					@if($user->description->getLiveplace())
						<p>{{$user->description->getLiveplace()}}</p>
					@endif
					@if(count($jobs) > 0)
					<p>
						@foreach($jobs as $job)
						{{$job}}
						@endforeach
					</p>
					@endif
					<div class="full-information">asdasdsad</div>
				</li>

				<div class="clear"></div>
			</ul>
			<div class="b-profile-middle__button">Показать полную информацию
				
			</div> -->
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
			<li class="b-user-navigation-list__list tab-link current" data-tab="tab-1" ><a href="{{URL::to('profile/'.$user->id)}}">Лента</a></li>
			<li class="b-user-navigation-list__list" data-tab="tab-4"><a href="{{URL::to('profile/'.$user->id.'/publications')}}">Публикации</a><span>{{$user->publications(10000)->count()}}</span></li>
			<li class="b-user-navigation-list__list" data-tab="tab-3"><a href="{{URL::to('profile/'.$user->id.'/friends')}}">Друзья</a><span>{{$user->friends()->count()}}</span></li>
			<li class="b-user-navigation-list__list"><a href="{{URL::to('profile/'.$user->id.'/subscriptions')}}">Подписано</a><span>{{$user->subscriptions()->count()}}</span></li>
			<div class="clear"></div>
		</ul>
	</div>
</div>

@include('profile.show.body', compact('items', 'page'))
</div>
@stop