@extends('misc.layout')
@extends('message.layout')
@section('form')
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Друзья</h4>
        {{Form::hidden('page', 'contact')}}
    </div>
    <div class="panel-body" id="messages">
        {{Form::open(array('url' => 'messages/action', 'name' => 'messages'))}}
        <div class="tab-content">
            <div class="tab-pane active" id="friends">
                @foreach(Friend::friendsList(Auth::id()) as $friend)
                <p class='' style="padding:5px;border: 1px solid #D2D2D2;">
                    <img src='{{asset($friend->user_profile_avatar)}}' style='width:50px;height:50px;'> 
                    {{$friend->first_name.' '.$friend->last_name}} 
                    {{HTML::link('messages/new?receiver='.$friend->first_name.'+'.$friend->last_name, 'Написать сообщение', array('style' => 'float:right;line-height:50px;'))}}
                </p>
                @endforeach
            </div>
            <div class="tab-pane" id="groups">
                
            </div>
        </div>
        {{Form::close()}}
    </div>
</div>
@stop