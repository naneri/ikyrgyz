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
            <legend>{{ trans('network.load-photo') }}</legend>
            <div class="form-group">
                {{Form::file('images[]', array('class' => 'form-control', 'multiple' => true, 'accept' => 'image/*'))}}
            </div>
            <div class="form-group">
                {{Form::hidden('photo_album_id', $photoAlbum->id)}}
                {{Form::submit(trans('network.save'))}}
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
@stop