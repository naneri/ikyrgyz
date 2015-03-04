@extends('misc.layout')
@extends('message.layout')
@section('form')
<div class="panel panel-default">
    {{Form::open(array('url' => 'messages/action', 'name' => 'messages'))}}
    <div class="panel-heading">
        {{Form::checkbox('check-all')}}
        {{Form::select('action', array('' => 'Выберите действие', 'restore' => 'Восстановить', 'force_delete' => 'Удалить без возможности восстановления'))}}
        {{HTML::link('messages/inbox/friend', 'Друзья')}}
        {{HTML::link('messages/inbox/group', 'Группы')}}
        {{HTML::link('messages/inbox/event', 'События')}}
        {{HTML::link('messages/inbox/all', 'Все')}}
        {{Form::hidden('page', 'trash')}}
    </div>
    <div class="panel-body" id="messages">
        @include('message.build.messages', array('messages' => Auth::user()->messagesTrashed()))
    </div>
    {{Form::close()}}
</div>
@stop