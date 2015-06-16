@extends('misc.layout')
@extends('message.layout')
@section('form')
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>{{ trans('network.edit-message') }}</h4>
    </div>
    <div class="panel-body">
        @foreach ($errors->all() as $error)
            <div class="b-message b-message-error">
                <a href="javascript: $('.b-message').remove()" class="b-message-close"></a>
                <div class="b-message-icon b-message-error-icon"></div>
                <p class="b-message-p">
                    {{$error}}
                </p>
            </div>
        @endforeach
        <fieldset>
        {{Form::open(array('url' => 'messages/new','files' => true))}}
            <div class="form-group">
                {{Form::text('receiver', $message->receiver->getNames(), array('class' => 'form-control'))}}{{HTML::link('#', trans('network.contacts'), array('id' => 'contacts'))}}<br>
                <div id="contacts-list" style="display: none;">
                    @foreach(Auth::user()->friends() as $friend)
                        <a onclick="addReceiver('{{$friend->first_name.' '.$friend->last_name}}')">{{$friend->first_name.' '.$friend->last_name}}</a><br>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                {{Form::text('title', $message->title, array('class' => 'form-control'))}}
            </div>
            <div class="form-group">
                {{Form::textarea('text', $message->text, array('class' => 'form-control'))}}
            </div>
        <div class="form-group">
                @if($message->attachments->count() > 0)
                <p><br>
                    Прикрепленные файлы:<br>
                    @foreach($message->attachments as $attachment)
                    {{HTML::link(asset($attachment->path), $attachment->name, array('target' => '_blank'))}}<br>
                    @endforeach
                </p>
                @endif
                {{Form::file('attachments[]', array('multiple' => true, 'class' => 'form-control'))}}
            </div>
            <div class="form-group">
                {{Form::hidden('is_draft', '0')}}
                {{Form::hidden('message_id', $message->id)}}
                {{Form::submit(trans('network.draft'), array('name' => 'draft'))}}
                {{Form::submit('Отправить', array('name' => 'publish'))}}
            </div>
        {{Form::close()}}
        </fieldset>
    </div>
</div>
<script>
    function addReceiver(receiverEmail){
        $('form input[name="receiver"]').val(receiverEmail);
        $('#contacts-list').hide();
    }
    $('form input[name="draft"]').click(function(){
       $('form input[name="is_draft"]').val('1'); 
    });
    $('#contacts').click(function(){
       $('#contacts-list').show(); 
    });
</script>
@stop