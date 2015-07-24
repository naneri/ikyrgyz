@extends('misc.layout')
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
            <legend>Изменение аудио</legend>
            <div class="form-group">
                {{ trans('network.hidden') }}
                {{Form::checkbox('is_hidden', $audio->is_hidden, $audio->is_hidden)}}
            </div>
            <div class="form-group">
                {{Form::file('audio_file', null, array('class' => 'form-control'))}}
            </div>
            <div class="form-group">
                Название
                {{Form::text('name', $audio->name, array('class' => 'form-control'))}}
            </div>
            <div class="form-group">
                Альбом
                {{Form::select('album_id', $audioAlbums, $audio->album->id, array('class' => 'form-control'))}}
            </div>
            <div class="form-group">
                {{Form::hidden('url', $audio->url)}}
                {{Form::hidden('is_hidden', $audio->is_hidden)}}
                {{Form::submit('Сохранить')}}
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
<script>
    $('form input[name="is_hidden"]').change(function(){
        $('form input[name="is_hidden"]').val($('form input[name="is_hidden"]').is(":checked")? '1' : '0');
    });
</script>
@stop