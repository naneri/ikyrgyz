@if($users)
    @foreach($users as $user)
        <div class="b-user-interface-content-profile">
            
            <div class="b-user-interface-content-profile__left">
            <a href="{{URL::to('profile/'.$user->id)}}"> 
                <img src="{{asset(($user->user_profile_avatar)?$user->user_profile_avatar:'img/20.png')}}" alt="" class="b-user-interface-content-profile__image"/>
                </a>
               </div>
             
            <div class="b-user-interface-content-profile__center">
                <a href="{{URL::to('profile/'.$user->id)}}"> 
                <p class="b-user-interface-content-profile__name">{{$user->first_name.' '.$user->last_name}}</p>
                </a>
            
            <p class="b-user-interface-content-profile__desc">
                @if($user->age)
                    <span>{{$user->age}},</span>
                @endif
                <span>{{($user->city)?$user->city.',':''}}</span>
                <span>{{($user->country)?$user->country:''}}</span>
            </p>
            </div>
            <div class="b-user-interface-content-profile__buttons">
                <a href="{{URL::to('profile/'.$user->id)}}"><input type="button" value="{{ trans('network.profile') }}" class="button-default button-profile" /></a>
                @if($user->friendStatus == Config::get('social.friend_status.friends'))
                    <a href="{{URL::to('messages/new?receiver='.$user->first_name.' '.$user->last_name)}}"><input type="button" value="{{ trans('network.message') }}" class="button-default button-add"/></a>
                @elseif($user->friendStatus == Config::get('social.friend_status.friend_send_request'))
                    <a href="{{URL::to('people/removeFriend/'.$user->id)}}"><input type="button" value="Отменить запрос" class="button-default button-add"/></a>
                @elseif($user->friendStatus == Config::get('social.friend_status.friends_got_request'))
                    <a href="{{URL::to('people/submitFriend/'.$user->id)}}"><input type="button" value="Принять запрос" class="button-default button-add"/></a>
                @else
                    <a href="{{URL::to('people/friendRequest/'.$user->id)}}"><input type="button" value="{{ trans('network.become-friend') }}" class="button-default button-add"/></a>
                @endif
            </div>
            <div class="clear"></div>
        </div>
    @endforeach
@else
    По данным критериям пользователей не найдено
@endif