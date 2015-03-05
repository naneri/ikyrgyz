@extends('misc.layout')
@extends('message.layout')
@section('form')
{{Form::open(array('url' => 'messages/action', 'name' => 'messages'))}}
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Исходящие</h4>
        {{Form::checkbox('check-all')}}
        {{Form::select('action', array('' => 'Выберите действие', 'delete' => 'Удалить'))}}
        {{Form::hidden('page', 'outbox')}}
    </div>
    <div class="panel-body" id="messages">
        @include('message.build.messages', array('messages' => Auth::user()->messagesOutbox))
    </div>
</div>
{{Form::close()}}
@stop