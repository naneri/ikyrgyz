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
                <ul>
                @foreach(Friend::friendsList(Auth::id()) as $friend)
                    <li>{{$friend->first_name.' '.$friend->last_name}}</li>
                @endforeach
                </ul>
            </div>
            <div class="tab-pane" id="groups">
                
            </div>
        </div>
        {{Form::close()}}
    </div>
</div>
@stop