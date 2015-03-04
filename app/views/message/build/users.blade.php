<div class="panel-group" id="accordion">
    @foreach($users as $user)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$user->id}}">
                    <img src='{{asset($user->description->user_profile_avatar)}}' style='width:50px;height:50px;'>
                    {{$user->description->first_name}}
                </a>
                <a data-toggle="collapse" href="#" onclick="unblockUser({{$user->id}})" style="float:right;">
                    X
                </a>
            </h4>
        </div>
        <div id="collapse{{$user->id}}" class="panel-collapse collapse">
            <div class="panel-body">
                @include('message.build.messages', array('messages' => Auth::user()->messagesOf($user->id)->get()))
            </div>
        </div>
    </div>
    @endforeach
</div>