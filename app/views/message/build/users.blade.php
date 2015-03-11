<div class="panel-group" id="accordion">
    @if($users->count() > 0)
    @foreach($users as $user)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$user->id}}">
                    @if(isset($user->avatar()))
                        <img src='{{asset($user->avatar())}}' style='width:50px;height:50px;'>
                    @else
                        <img src='{{ URL::to("img/12.png") }}' style='width:50px;height:50px;'>
                    @endif    
                    {{$user->getNames()}}
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
    @else
        Пользователей по данному запросу не найдено
    @endif
</div>