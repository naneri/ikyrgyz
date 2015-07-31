@foreach($notes as $note)
    <a href="{{$note->link}}">{{Lang::get($note->type->notify_page_message, unserialize($note->body))}}</a>
@endforeach