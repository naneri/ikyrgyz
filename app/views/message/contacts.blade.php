@extends('misc.layout')
@extends('message.layout')
@section('form')
<div class="panel panel-default">
    {{Form::open(array('url' => 'messages/action', 'name' => 'messages'))}}
    <div class="panel-heading">
        {{Form::hidden('page', 'contact')}}
    </div>
    <div class="panel-body" id="messages">
        <!-- Nav tabs -->
        <ul class="nav nav-pills nav-justified">
            <li class="active"><a href="#friends" data-toggle="tab">Друзья</a></li>
            <li><a href="#groups" data-toggle="tab">Группы</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="friends">
                <ul>
                @foreach(Friend::friendsList(Auth::id()) as $friend)
                    <li>{{$friend->email}}</li>
                @endforeach
                </ul>
            </div>
            <div class="tab-pane" id="groups">
                
            </div>
        </div>
    </div>
    {{Form::close()}}
</div>
@stop