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
        Сообщение: {{$message->text}}<br>
        @if($message->attachments->count() > 0)
            <p><br>
                Прикрепленные файлы:<br>
                @foreach($message->attachments as $attachment)
                    {{HTML::link(asset($attachment->path), $attachment->name, array('target' => '_blank'))}}<br>
                @endforeach
            </p>
        @endif
        @if($message->draft && $message->sender_id == Auth::id())
            <br>
            Сообщение еще находится в черновиках.<br>
            {{HTML::link('message/send/'.$message->id, 'Отправить')}} |
            {{HTML::link('message/edit/'.$message->id, 'Редактировать')}} |
            {{HTML::link('message/delete/'.$message->id, 'Удалить')}}
        @endif
    </div>
</div>
@stop