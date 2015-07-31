@extends("{$template}misc.layout")
@section('content')
{{HTML::style('css/bootstrap.css')}}
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        @foreach ($errors->all() as $error)
            <div class="b-message b-message-error">
                <a href="javascript: $('.b-message').remove()" class="b-message-close"></a>
                <div class="b-message-icon b-message-error-icon"></div>
                <p class="b-message-p">
                    {{$error}}
                </p>
            </div>
        @endforeach
        <div class="panel" style="padding:10px;">
            {{Form::open(array('files' => true))}}
                <legend>{{ trans('network.create-audioalbum') }}</legend>
                <div class="form-group">
                    {{Form::text('name', null, array('class' => 'form-control', 'placeholder' => trans('network.choose-name')))}}
                </div>
                <div class="form-group">
                    {{Form::select('access', array('all' => 'Всем', 'friend' => 'Друзьям', 'me' => 'Только мне'), null, array('class' => 'form-control'))}}
                </div>
                <div class="form-group">
                    {{Form::file('image', array('class' => 'form-control'))}}
                </div>
                <div class="form-group">
                    {{Form::textarea('description', null, array('class' => 'form-control', 'placeholder' => 'Описание аудиоальбома'))}}
                </div>
                <div class="form-group">
                    {{Form::submit(trans('save'))}}
                </div>
            {{Form::close()}}
        </div>
    </div>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@stop