@extends('misc.layout')

@section('content')


<div class="b-content">
    <div class="b-user-profile">
        @if(isset($user->description->user_profile_avatar))
        <div class="b-user-profile__left"><a href="#" class="user-image"><img  src="{{ asset($user->description->user_profile_avatar) }}" alt="" style="max-width: 244px;max-height: 244px;"/></a>
            <p class="user-link-photo"><a href="#">Загрузить фото</a></p>
        </div>
        @else
        <div class="b-user-profile__left"><a href="#" class="user-image"><img  src="{{ asset('images/content/12.png') }}" alt=""/></a>
            <p class="user-link-photo"><a href="#">Загрузить фото</a></p>
        </div>
        @endif

        <div class="b-user-profile__middle">
            <p class="user-raiting">Рейтинг <span class="num">{{$user->rating}}</span></p>
            <p class="user-name">{{$user->getNames()}}</p>
            <p class="user-date">{{$user->description->birthday}}, {{$gender}}, {{$maritalStatus}}</p>
            <p class="user-date">Место рождения: {{Country::find($user->description->birthplace_country_id)->name_ru}}, {{City::find($user->description->birthplace_city_id)->name_ru}}</p>
            <p class="user-date">Проживает: {{Country::find($user->description->liveplace_country_id)->name_ru}}, {{City::find($user->description->liveplace_city_id)->name_ru}}</p>
            <p class="user-date">
                @foreach($user->profileItemsValues('address') as $address)
                    {{$address}}, 
                @endforeach
            </p>
            <p class="user-date">
                @foreach($user->profileItemsValues('school') as $school)
                    {{$school}}, 
                @endforeach
            </p>
            <p class="user-date">
                @foreach($user->profileItemsValues('university') as $university)
                    {{$university}}, 
                @endforeach
            </p>
            <p class="user-date">
                @foreach($user->profileItemsValues('job') as $job)
                    {{$job}}, 
                @endforeach
            </p>
            <p class="user-date">
                @foreach($user->profileItemsValues('phone') as $phone)
                    {{$phone}}, 
                @endforeach
            </p>
            <p class="user-date">
                @foreach($user->profileItemsValues('email') as $email)
                    {{$email}}, 
                @endforeach
            </p>            
        </div>
        <div class="b-user-profile__right">
            <div class="b-user-profile-link"><a href="#" class="b-user-profile-link__create">Создать</a></div>
            <ul class="b-user-profile-links">
                <li class="b-user-profile-links__list"><a href="{{URL::to('topic/create')}}"></a></li>
                <li class="b-user-profile-links__list"><a href="{{URL::to('blog/create')}}"></a></li>
                <!--li class="b-user-profile-links__list"><a href="#"></a></li>
                <li class="b-user-profile-links__list"><a href="#"></a></li>
                <li class="b-user-profile-links__list"><a href="#"></a></li>
                <li class="b-user-profile-links__list"><a href="#"></a></li>
                <li class="b-user-profile-links__list"><a href="#"></a></li-->
                <div class="clear"></div>
            </ul>
            <ul class="b-user-profile-buttons">
                <li class="b-user-profile-buttons__list"><a href="{{URL::to('messages/new')}}">Отравить сообщение<span class="msg-image"></span></a></li>
                <li class="b-user-profile-buttons__list"><a href="{{URL::to('search/people')}}">Поиск друзей<span class="search-image"></span></a></li>
                <li class="b-user-profile-buttons__list"><a href="#">Системные сообщения<span class="system-image"></span></a></li>
                <li class="b-user-profile-buttons__list"><a href="{{URL::to('profile/random')}}">Случайный профиль<span class="random-image"></span></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <div class="b-user-navigation">
        <ul class="b-user-navigation-list">
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/newsline')}}">Лента</a></li>
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/publications')}}">Публикации</a><span>{{$user->topics->count()}}</span></li>
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/friends')}}">Друзья</a><span>{{$user->friends()->count()}}</span></li>
            <li class="b-user-navigation-list__list"><a href="{{URL::to('profile/subscribtions')}}">Подписки</a></li>
            <a href="{{URL::to('profile/edit/main')}}" class="b-user-navigation-list__setting">Настройки</a>
            <div class="clear"></div>
        </ul>
    </div>
    
    @include('profile.show.body', compact('items', 'page'))
    
        <div class="clear"></div>
    </div>
</div>

</div>
@stop