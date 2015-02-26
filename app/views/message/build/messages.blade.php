@foreach($messages as $message)
    <div>
        {{Form::checkbox('messages[]', $message->id)}}
        {{$message->sender->email}} | 
        <a href="{{URL::to('message/show/' . $message->id)}}">{{$message->text}}</a>
        @if(!$message->watched && $message->sender_id != Auth::id())
        <span style="background: rgb(255, 140, 0); font-size:10px; padding: 2px;">
            new
        </span>
        @endif
    </div>
@endforeach