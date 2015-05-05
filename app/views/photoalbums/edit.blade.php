
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
            <legend>Изменить фотоальбом</legend>
            <div class="form-group">
                {{Form::text('name', $photoAlbum->name, array('class' => 'form-control', 'placeholder' => 'введите название'))}}
            </div>
            <div class="form-group">
                {{Form::select('access', array('all' => 'Всем', 'friend' => 'Друзьям', 'me' => 'Только мне'), $photoAlbum->access, array('class' => 'form-control'))}}
            </div>
            <div class="form-group">
                {{Form::file('image', array('class' => 'form-control'))}}
                <br>
                {{HTML::image($photoAlbum->cover)}}
            </div>
            <div class="form-group">
                {{Form::textarea('description', $photoAlbum->description, array('class' => 'form-control', 'placeholder' => 'Описание фотоальбома'))}}
            </div>
            <div class="form-group">
                {{Form::submit('Сохранить')}}
            </div
            {{Form::close()}}
        </div>
    </div>
</div>
@stop