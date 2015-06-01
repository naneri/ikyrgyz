<div class="panel panel-default">
        @foreach ($errors->all() as $error)
            <div class="b-message b-message-error">
                <a href="javascript: $('.b-message').remove()" class="b-message-close"></a>
                <div class="b-message-icon b-message-error-icon"></div>
                <p class="b-message-p">
                    {{$error}}
                </p>
            </div>
        @endforeach
    @if($message->sender_id == Auth::id() || $message->receiver_id == Auth::id())
        <h4>Отправитель: {{$message->sender->getNames()}}</h4>
        <h5>Получатель: {{$message->receiver->getNames()}}</h5>
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
            {{HTML::link('messages/new?receiver='.$message->sender->getNames(), trans('network.reply'))}} 
        @endif
    </div>
    @else
        <div class="panel-body">
            Вы не имеете доступа к данному сообщению
        </div>
    @endif
</div>