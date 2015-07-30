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
            <legend>{{ trans('network.photo-changing') }}</legend>
            <div class="form-group">
                {{Form::file('image', null, array('class' => 'form-control'))}}
                {{HTML::image($photo->url, null, array('style' => 'max-width:700px;'))}}
            </div>
            <div class="form-group">
                {{Form::text('name', $photo->name, array('class' => 'form-control'))}}
            </div>
            <div class="form-group">
                {{Form::hidden('photo_album_id', $photo->album->id)}}
                {{Form::hidden('url', $photo->url)}}
                {{Form::submit(trans('network.save'))}}
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
@stop