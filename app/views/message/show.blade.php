@extends('misc.layout')
@extends('message.layout')
@section('form')
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Отправитель: {{$message->sender->description->first_name.' '.$message->sender->description->last_name}}</h4>
        <h5>Получатель: {{$message->receiver->description->first_name.' '.$message->receiver->description->last_name}}</h5>
    </div>
    <div class="panel-body">
        <b>Тема: {{$message->title}}</b><br>
        Сообщение: {{$message->text}}
    </div>
</div>
@stop