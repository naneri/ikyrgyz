@extends('misc.layout')
@extends('message.layout')
@section('form')
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Новое сообщение</h4>
    </div>
    <div class="panel-body">
        <div class="all-alerts">
            @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                {{$error}}
            </div>
            @endforeach
        </div>
        <fieldset>
        {{Form::open(array('files' => true))}}
            <div class="form-group">
                {{Form::text('receiver', 'Кому', array('class' => 'form-control'))}}{{HTML::link('#', 'Контакты', array('id' => 'contacts'))}}<br>
                <div id="contacts-list" style="display: none;">
                    @foreach(Auth::user()->friends() as $friend)
                        <a onclick="addReceiver('{{$friend->first_name.' '.$friend->last_name}}')">{{$friend->first_name.' '.$friend->last_name}}</a><br>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                {{Form::text('title', 'Тема', array('class' => 'form-control'))}}
            </div>
            <div class="form-group">
                {{Form::textarea('text', 'Сообщение', array('class' => 'form-control'))}}
            </div>
            <div class="form-group">
                {{Form::file('attachments[]', array('multiple' => true, 'class' => 'form-control'))}}
            </div>
            <div class="form-group">
                {{Form::hidden('is_draft', '0')}}
                {{Form::submit('Черновик', array('name' => 'draft'))}}
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