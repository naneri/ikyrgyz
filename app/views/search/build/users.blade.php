@if($users)
    @foreach($users as $user)
    <?php $userPersonalBlog = Blog::getPersonalBlog($user->id); ?>
        <div style="padding: 10px;border:1px solid #bbb;margin-bottom: 10px;">
            <img src="{{asset($user->user_profile_avatar)}}" style="float:left;width:60px;height:60px;margin-right: 10px;"/> 
            <div>{{$user->first_name}} {{$user->last_name}}</div>
            <div>{{date_diff(date_create(@$user->birthday), date_create('today'))->y;}}, {{@$user->country}}</div>
            <div>
                [{{HTML::link('profile/'.$user->id, 'Посмотреть профиль')}}]
                @if($userPersonalBlog)
                [{{HTML::link('blog/'.$userPersonalBlog->id.'/read', 'Подписаться')}}]
                @endif
                [{{HTML::link('people/friendRequest/'.$user->id, 'Стать друзьями')}}]
            </div>
        </div>
    @endforeach
@else
    По данным критериям пользователей не найдено
@endif