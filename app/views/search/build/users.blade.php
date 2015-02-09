@if($users)
    @foreach($users as $user)
        <div style="width:100%; height: 110px;">
            <img src="{{asset($user->user_profile_avatar)}}" style="float:left;width:100px;height:100px;"/> 
            <div>{{$user->first_name}} {{$user->last_name}} {{$user->email}}</div>
            <div>{{date_diff(date_create($user->birthday), date_create('today'))->y;}}, {{$user->country}}</div>
            <div>
                [{{HTML::link('profile/'.$user->id, 'Посмотреть профиль')}}]
                [{{HTML::link('', 'Написать ЛС')}}]
                [{{HTML::link('', 'Подписаться')}}]
                [{{HTML::link('people/friendRequest/'.$user->id, 'Стать друзьями')}}]
            </div>
        </div>
    @endforeach
@else
    По данным критериям пользователей не найдено
@endif