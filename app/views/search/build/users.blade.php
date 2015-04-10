@if($users)
    @foreach($users as $user)
        <div class="b-user-interface-content-profile">
            <a href="{{URL::to('profile/'.$user->id)}}">
                <img src="{{asset(($user->user_profile_avatar)?$user->user_profile_avatar:'img/20.png')}}" alt="" class="b-user-interface-content-profile__image"/>
                <p class="b-user-interface-content-profile__name">{{$user->first_name.' '.$user->last_name}}</p>
            </a>
            <p class="b-user-interface-content-profile__desc">
                <span>{{date_diff(date_create(@$user->birthday), date_create('today'))->y;}},</span>
                <span>{{($user->city)?$user->city.',':''}}</span>
                <span>{{($user->country)?$user->country:''}}</span>
            </p>
            <div class="b-user-interface-content-profile__buttons">
                <a href="{{URL::to('profile/'.$user->id)}}"><input type="button" value="Профиль" class="button-default button-profile" /></a>
                <a href="{{URL::to('people/friendRequest/'.$user->id)}}"><input type="button" value="Дружить" class="button-default button-add"/></a>
            </div>
            <div class="clear"></div>
        </div>
    @endforeach
@else
    По данным критериям пользователей не найдено
@endif