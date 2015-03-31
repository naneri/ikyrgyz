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