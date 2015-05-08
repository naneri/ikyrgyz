@include('scripts.convert-times')
<script>
$(document).ready(function() {
  times.init('.time-converter-inboxm');
  times.eachConvert('.time-converter-inbox');
})
</script>
@if($messages->count() > 0)
@foreach($messages as $message)
    <div style="margin-bottom: 10px;border: 1px solid #D2D2D2;padding: 5px" class="time-converter-inboxm">
        {{Form::checkbox('messages[]', $message->id)}}
        @if($message->sender_id == Auth::id())
            <img style="width:50px;height:50px;" src="{{asset($message->receiver->avatar())}}" />
            {{$message->receiver->getNames()}} | 
        @elseif($message->receiver_id == Auth::id())
            <img style="width:50px;height:50px;" src="{{asset($message->sender->avatar())}}" />
            {{$message->sender->getNames()}} | 
        @endif
        <a href="{{URL::to('message/show/' . $message->id)}}">{{$message->title}}</a>
        {{mb_substr(strip_tags($message->text), 0, 200, 'UTF-8') }}
        @if(!$message->watched && $message->sender_id != Auth::id())
        <span style="background: rgb(255, 140, 0); font-size:10px; padding: 2px;">
            new
        </span>
        @endif
        <span style="float: right; line-height: 50px;" class="time-converter-inbox">
            <span style="float: right; line-height: 50px;"><span class="date moment-time"></span>
            <span class="date moment-time-hover"></span><span class="date original-time">{{$message->created_at}}</span>
        </span>
        </span>
        @if($message->attachments->count() > 0)
            <img style="float: right; margin: 10px; height: 16px;" src="{{asset('images/icon-attachment.png')}}" alt=""/>
        @endif
    </div>
@endforeach
<div style="width: 100%; text-align: center">
        <?php echo $messages->links(); ?>
    </div>
@else
    {{ trans('network.mess-not-found') }}
@endif
