@extends('misc.layout')
@extends('message.layout')
@section('form')
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Черновики</h4>
        {{Form::checkbox('check-all')}}
        {{Form::select('action', array('' => 'Выберите действие', 'delete' => 'Удалить'))}}
        {{Form::hidden('page', 'draft')}}
    </div>
    {{Form::open(array('url' => 'messages/action', 'name' => 'messages'))}}
    <div class="panel-body" id="messages">
        @include('message.build.messages', array('messages' => Auth::user()->messagesDraft))
    </div>
    {{Form::close()}}
</div>
@stop