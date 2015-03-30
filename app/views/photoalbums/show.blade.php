@extends('misc.layout')
@section('content')
{{HTML::style('css/bootstrap.css')}}
<div class="container">
    <div class="col-md-12">
        <div class="panel panel-default" style="height: 40px; padding:0 20px;">
            <h4 style="float: left;">{{$photoAlbum->name}}</h4>
            <span style="float: right;line-height: 38px;"><a href="{{URL::to('photoalbum/'.$photoAlbum->id.'/upload')}}">{{ trans('network.upload') }}</a></span>
        </div>
        <div>
            @if($photoAlbum->getOriginal('cover'))
                <div class="list-group-item" style="width:210px;height:210px;float:left;margin:5px;background:url({{$photoAlbum->cover}});background-size: cover;border: 2px solid white;">
                    <div style="height: 50px;  position: absolute;  bottom: 0;  background-color: #bbb;  width: 100%;  left: 0;  padding: 10px;  opacity: 0.8;">
                        {{ trans('network.photoalbum-cover') }}
                    </div>
                </div>
            @endif
            @foreach($photoAlbum->photos as $photo)
            <a href="{{URL::to('photo/'.$photo->id)}}">
                <div class="list-group-item" style="width:210px;height:210px;float:left;margin:5px;background:url({{$photo->url}});background-size: cover;border: 2px solid white;">
                    <div style="height: 50px;  position: absolute;  bottom: 0;  background-color: #bbb;  width: 100%;  left: 0;  padding: 10px;  opacity: 0.8;">
                        {{$photo->name}}
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@stop