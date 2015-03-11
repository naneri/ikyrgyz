@extends('misc.layout')
@extends('message.layout')
@section('form')
{{Form::open(array('url' => 'messages/action', 'name' => 'messages'))}}
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Контакты</h4>
        {{Form::hidden('page', 'contact')}}
    </div>
    <div class="panel-body" id="messages">
        <div class="tab-content">
            <div class="tab-pane active" id="friends">
                @foreach(Friend::friendsList(Auth::id()) as $friend)
                <p class='' style="padding:5px;border: 1px solid #D2D2D2;">
                    @if(isset($friend->user_profile_avatar)) 
                        <img src='{{asset($friend->user_profile_avatar)}}' style='width:50px;height:50px;'>
                    @else
                        <img src='{{ URL::to("img/12.png") }}' style='width:50px;height:50px;'>
                    @endif    
                    {{$friend->first_name.' '.$friend->last_name}} 
                    {{HTML::link('messages/new?receiver='.$friend->first_name.'+'.$friend->last_name, 'Написать сообщение', array('style' => 'float:right;line-height:50px;'))}}
                </p>
                @endforeach
            </div>
            <div class="tab-pane" id="groups">
                
            </div>
        </div>
    </div>
</div>
{{Form::close()}}
@stop