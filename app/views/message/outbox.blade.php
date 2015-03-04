@extends('misc.layout')
@extends('message.layout')
@section('form')
<div class="panel panel-default">
    {{Form::open(array('url' => 'messages/action', 'name' => 'messages'))}}
    <div class="panel-heading">
        {{Form::checkbox('check-all')}}
        {{Form::select('action', array('' => 'Выберите действие', 'delete' => 'Удалить'))}}
        {{Form::hidden('page', 'outbox')}}
    </div>
    <div class="panel-body" id="messages">
        @include('message.build.messages', array('messages' => Auth::user()->messagesOutbox))
    </div>
    {{Form::close()}}
</div>
@stop