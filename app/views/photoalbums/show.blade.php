@extends('misc.layout')
@section('content')
{{HTML::style('css/bootstrap.css')}}
<div class="container">
    <div class="col-md-12">
        <div class="panel panel-default" style="height: 40px; padding:0 20px;">
            <h4 style="float: left;">
                <a href="{{URL::to('profile/'.$photoAlbum->user->id)}}">{{$photoAlbum->user->getNames()}}</a> →
                <a href="{{URL::to('profile/'.$photoAlbum->user->id.'/photos')}}">Фотоальбомы</a> → 
                {{$photoAlbum->name}}
            </h4>
            @if($photoAlbum->canEdit())
                <span style="float: right;line-height: 38px;">
                    <a href="{{URL::to('photoalbum/'.$photoAlbum->id.'/delete')}}">Удалить фотоальбом</a> |
                    <a href="{{URL::to('photoalbum/'.$photoAlbum->id.'/edit')}}">Изменить фотоальбом</a> |
                    <a href="{{URL::to('photoalbum/'.$photoAlbum->id.'/upload')}}">Загрузить фотографии</a>
                </span>
            @endif
        </div>
        <div>
            @if($photoAlbum->canView())
                @if($photoAlbum->description)
                    <div class="panel panel-default" style="height: 40px; padding:0 20px;">
                        <h5><b>Описание:</b> {{$photoAlbum->description}}</h5>
                    </div>
                @endif
                {{--@if($photoAlbum->getOriginal('cover'))
                    <div class="list-group-item" style="width:210px;height:210px;float:left;margin:5px;background:url({{$photoAlbum->cover}}) 50%;background-size: cover;border: 2px solid white;">
                        <div style="height: 50px;  position: absolute;  bottom: 0;  background-color: #bbb;  width: 100%;  left: 0;  padding: 10px;  opacity: 0.8;">
                            Обложка фотоальбома
                        </div>
                    </div>
                @endif--}}
                <div id="gallery">
                        @foreach($photoAlbum->photos as $photo)
                            <a href="{{$photo->url}}">
                                <div class="list-group-item" style="width:210px;height:210px;float:left;margin:5px;background:url({{$photo->url}}) 50%;background-size: cover;border: 2px solid white;">
                                    <div style="height: 50px;  position: absolute;  bottom: 0;  background-color: #bbb;  width: 100%;  left: 0;  padding: 10px;  opacity: 0.8;">
                                        {{$photo->name}}
                                    </div>
                                </div>
                                <img src="{{$photo->url}}" alt="{{$photo->name}}" style="display: none;">
                            </a>
                        @endforeach
                    </ul>
                </div>
                <div class="gamma-overlay"></div>
            @else 
                <div class="panel panel-default" style="height: 40px; padding:0 20px;">
                    <h5 style="">
                        Фото альбом не доступен для просмотра
                    </h5>
                </div>
            @endif
        </div>
    </div>
</div>
@include('scripts.photobox')
@stop