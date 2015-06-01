@include('scripts.convert-times')
<script>
$(document).ready(function() {
  times.init('.time-converter-inbox');
  times.eachConvert('.time-converter-inbox');
})
</script>
@foreach($messages as $message)
<tr>
    <td>
        <ul>
            <li class="b-message-ls-mark__list b-message-ls-mark__list_second">
                <div class="b-message-ls-mark__checkbox b-message-ls-mark__checkbox_second">
                    {{Form::checkbox('messages[]', $message->id)}}
                </div>
            </li>
            <li class="b-message-ls-mark__list">
                <div class="b-message-ls-mark__image">
                    <img style="width: 50px;height:50px;" src="{{($message->sender_id == Auth::id())?$message->receiver->avatar():$message->sender->avatar()}}" alt="">
                </div>
            </li>
            <li class="b-message-ls-mark__list">
                <div class="b-message-ls-mark-desc" style="width:400px;">
                    <a style="cursor: pointer" onclick="message.show({{$message->id}})">
                        <div class="b-message-ls-mark-desc__title">{{mb_substr(strip_tags($message->title), 0, 200, 'UTF-8') }}</div>
                    </a>
                    <div class="b-message-ls-mark-desc__name">
                        {{($message->sender_id == Auth::id())?$message->receiver->getNames():$message->sender->getNames()}}</div>
                </div>	
            </li>
            <li class="b-message-ls-mark__list">
                <div class="b-message-ls-mark-num" style="width: 180px;">
                    <div class="b-message-ls-mark-num__image" style="height: auto;"><img src="{{asset('img/119.png')}}" alt=""></div>
                    <span class="time-converter-inbox">
                        <span class="date moment-time"></span>
                        <span class="date moment-time-hover"></span>
                        <span class="date original-time">{{$message->created_at}}</span>
                    </span>
                </div>
            </li>
        </ul>
    </td>
</tr>
@endforeach
<div style="width: 100%; text-align: center">
        <?php echo $messages->links(); ?>
    </div>


   {{-- trans('network.mess-not-found') --}}
