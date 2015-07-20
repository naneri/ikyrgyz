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
                    @if($photoAlbum->canEdit())
                    <div class="panel panel-default" style="height: 40px; padding: 8px 20px;">
                        Выберите действие: 
                        <select id="photo_action">
                            <option value="">-</option>
                            <option value="delete">Удалить</option>
                            <option value="copy">Копировать</option>
                            <option value="move">Переместить</option>
                        </select>
                        <input type="button" value="ОК!" id="submit_action"/>
                    </div>
                    <script>
                        $(function(){
                            $('#submit_action').click(function(){
                                var action = $('#photo_action').val();
                                if(action == ''){
                                    alert('Choose action!');
                                    return;
                                }
                                var data = $('form#photos').serialize();
                                $.ajax({
                                    url: '{{URL::to("photos/action")}}/'+action,
                                    data: data,
                                    method: 'POST',
                                    success: function($result){
                                        if(!$result.error){
                                            $('#photoList').html($result.render);
                                        }
                                        $.each($result.results, function(key, value){
                                            $.notify(value['message'], value['status']);
                                        });
                                    }
                                });
                            });
                        });
                    </script>
                    @endif
                @endif
                {{--@if($photoAlbum->getOriginal('cover'))
                    <div class="list-group-item" style="width:210px;height:210px;float:left;margin:5px;background:url({{$photoAlbum->cover}}) 50%;background-size: cover;border: 2px solid white;">
                        <div style="height: 50px;  position: absolute;  bottom: 0;  background-color: #bbb;  width: 100%;  left: 0;  padding: 10px;  opacity: 0.8;">
                            Обложка фотоальбома
                        </div>
                    </div>
                @endif--}}
                <div id="gallery">
                    <form id="photos">
                        <div id="photoList">
                            @include('photos.list', array('photos' => $photoAlbum->photos, 'canEdit' => $photoAlbum->canEdit()))
                        </div>
                        <input type='hidden' name='photoAlbumId' value='{{$photoAlbum->id}}' />
                    </form>
                </div>
                @include('scripts.photobox')
                <!--script>
                    $('#gallery').photobox('a', {thumbs: false});
                </script-->
                <style>
                    
                </style>
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
@stop