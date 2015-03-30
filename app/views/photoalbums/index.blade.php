@extends('misc.layout')
@section('content')
{{HTML::style('css/bootstrap.css')}}
<div class="container">
    <div class="col-md-12">
        <div class="panel panel-default" style="height: 40px; padding:0 20px;">
            <h4 style="float: left;">{{ trans('network.user-photoalbums') }}</h4>
            <span style="float: right;line-height: 38px;"><a href="{{URL::to('photoalbum/create')}}">{{ trans('network.create') }}</a></span>
        </div>
        <div>
            @foreach($photoAlbums as $photoAlbum)
                <a href="{{URL::to('photoalbum/'.$photoAlbum->id)}}">
                    <div class="list-group-item" style="width:210px;height:210px;float:left;margin:5px;background:url({{$photoAlbum->cover}});background-size: cover;border: 2px solid white;">
                        <div style="height: 50px;  position: absolute;  bottom: 0;  background-color: #bbb;  width: 100%;  left: 0;  padding: 10px;  opacity: 0.8;">
                            {{$photoAlbum->name}}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@stop