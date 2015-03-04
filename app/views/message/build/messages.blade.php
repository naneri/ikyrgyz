@foreach($messages as $message)
    <div style="margin-bottom: 10px;border: 1px solid #D2D2D2;padding: 5px">
        {{Form::checkbox('messages[]', $message->id)}}
        @if($message->sender->id == Auth::id())
            <img style="width:50px;height:50px;" src="{{asset($message->receiver->description->user_profile_avatar)}}" />
            {{$message->receiver->description->first_name}} {{$message->receiver->description->last_name}} | 
        @elseif($message->receiver->id == Auth::id())
            <img style="width:50px;height:50px;" src="{{asset($message->sender->description->user_profile_avatar)}}" />
            {{$message->sender->description->first_name}} {{$message->sender->description->last_name}} | 
        @endif
        <a href="{{URL::to('message/show/' . $message->id)}}">{{$message->title}}</a>
        @if(!$message->watched && $message->sender_id != Auth::id())
        <span style="background: rgb(255, 140, 0); font-size:10px; padding: 2px;">
            new
        </span>
        @endif
        <span style="float: right; line-height: 50px;">{{ date('d-m-Y', strtotime ($message->created_at))}}</span>
        @if($message->attachments->count() > 0)
            <img style="float: right; margin: 10px;" src="{{asset('images/icon-attachment.png')}}" alt=""/>
        @endif
    </div>
@endforeach