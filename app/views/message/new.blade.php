@extends('misc.layout')
@extends('message.layout')
@section('form')
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>{{ trans('network.new-message') }}</h4>
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
        {{Form::open(array('files' => true))}}
            <div class="form-group">
                <div id="contacts-list">
                Кому:
                    @foreach(Auth::user()->friends() as $friend)
                        @if ($receiver!='' && $receiver==$friend->first_name.' '.$friend->last_name)
                            {{Form::checkbox('receivers[]', $friend->email, true);}}{{$friend->first_name.' '.$friend->last_name}}
                        @else
                            {{Form::checkbox('receivers[]', $friend->email);}}{{$friend->first_name}} {{$friend->last_name}}
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                {{Form::text('title', trans('network.message-topic'), array('class' => 'form-control'))}}
            </div>
            <div class="form-group">
                {{Form::textarea('text', trans('network.message'), array('class' => 'form-control'))}}
            </div>
            <div class="form-group">
                {{Form::file('attachments[]', array('multiple' => true, 'class' => 'form-control'))}}
            </div>
            <div class="form-group">
                {{Form::hidden('is_draft', '0')}}
                {{Form::submit( trans('network.draft'), array('name' => 'draft'))}}
                {{Form::submit( trans('network.send'), array('name' => 'publish'))}}
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
    $('form').submit(function(){
        if ($('form input[name="title"]').val()=='Тема')
            $('form input[name="title"]').val('Без темы');
    });
</script>
@stop