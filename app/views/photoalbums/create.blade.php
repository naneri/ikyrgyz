@extends('misc.layout')
@section('content')
{{HTML::style('css/bootstrap.css')}}
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="all-alerts">
            @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                {{$error}}
            </div>
            @endforeach
        </div>
        <div class="panel" style="padding:10px;">
            {{Form::open(array('files' => true))}}
                <legend>Создание фотоальбома</legend>
                <div class="form-group">
                    {{Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'введите название'))}}
                </div>
                <div class="form-group">
                    {{Form::select('access', array('all' => 'Всем', 'friend' => 'Друзьям', 'me' => 'Только мне'), null, array('class' => 'form-control'))}}
                </div>
                <div class="form-group">
                    <!--div id="dialog" title="Загрузить обложку">
                        <p>
                            <div class="form-group">
                                <label for="">с компьютера</label>
                                {{Form::file('from_pc',array('class' => 'form-control'))}}
                            </div>
                            <div class="form-group">
                                <label for="">из интернета</label>
                                {{Form::text('from_url', null, array('class' => 'form-control'))}}
                            </div>
                            <div class="form-group">
                                {{Form::button('OK', array('id' => 'upload_image_btn'))}}
                            </div>
                        </p>
                    </div-->
                    {{Form::file('image', array('class' => 'form-control'))}}
                    <!--<input type="button" id="upload_image_dialog" style="display: none;" value="Загрузить обложку" />-->
                </div>
                <div class="form-group">
                    {{Form::textarea('description', null, array('class' => 'form-control', 'placeholder' => 'Описание фотоальбома'))}}
                </div>
                <div class="form-group">
                    {{Form::submit('Сохранить')}}
                </div
            {{Form::close()}}
        </div>
    </div>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script>
  $(function() {
    /*$( "#dialog" ).dialog({
        autoOpen: false
    });
    $('#upload_image_dialog').click(function(){
        $( "#dialog" ).dialog( "open" );
    });
    $('#upload_image_btn').click(function(){
        var data = { 
            'from_pc': $('input[name="from_pc"').val(),
            'from_url': $('input[name="from_url"').val()
        };
        $.ajax({
            url: '{{URL::to("photoalbum/uploadCover")}}',
            data: data,
            method: 'POST',
            success: function($result){
                
            }
        })
        $( "#dialog" ).dialog( "close" );
    });*/
  });
</script>
@stop