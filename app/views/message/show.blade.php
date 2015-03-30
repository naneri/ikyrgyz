@extends('misc.layout')
@extends('message.layout')
@section('form')
<div class="panel panel-default">
    @if($message->sender_id == Auth::id() || $message->receiver_id == Auth::id())
    <div class="panel-heading">
        <h4>Отправитель: {{$message->sender->getNames()}}</h4>
        <h5>Получатель: {{$message->receiver->getNames()}}</h5>
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
            {{HTML::link('message/send/'.$message->id, trans('network.send'))}} |
            {{HTML::link('message/edit/'.$message->id, trans('network.edit'))}} |
            {{HTML::link('message/delete/'.$message->id, trans('network.delete'))}}
        @endif

        @if($message->sender_id != Auth::id())
            <br>
            {{HTML::link('messages/new', trans('network.reply'))}} 
        @endif
    </div>
    @else
        <div class="panel-body">
            Вы не имеете доступа к данному сообщению
        </div>
    @endif
</div>
@stop