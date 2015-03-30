@extends('misc.layout')
@extends('message.layout')
@section('form')
{{Form::open(array('url' => 'messages/action', 'name' => 'messages'))}}
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Входящие</h4>
        {{Form::checkbox('check-all')}}
        {{Form::select('action', array('' => trans('network.choose-action'), 'set_watch' => trans('set-watch'), 'set_notwatch' => trans('network.set-notwatch'), 'blacklist' => trans('blacklist'), 'delete' => trans('network.delete')))}}
        <!--{{HTML::link('messages/inbox/friend', 'Друзья')}}
        {{HTML::link('messages/inbox/group', 'Группы')}}
        {{HTML::link('messages/inbox/event', 'События')}}
        {{HTML::link('messages/inbox/all', 'Все')}}-->
        {{Form::hidden('page', 'inbox')}}
    </div>
    <div class="panel-body" id="messages">
        @include('message.build.messages', array('messages' => $messages))
    </div>
</div>
{{Form::close()}}
@stop