@extends('misc.layout')
@section('content')
{{HTML::style('css/bootstrap.css')}}
<div class="container">
    <div class="col-md-12">
        {{Form::open(array('url' => 'photoalbum/'.$albumId.'/upload/setnames'))}}
            <div class="panel panel-default" style="height: 40px; padding:0 20px;">
                <h4 style="float: left;">
                    Загрузка фотографии
                </h4>
                <span style="float: right; margin-top: 6px;">
                    {{Form::submit('Сохранить')}}
                </span>
            </div>
            <div>
                @foreach($photos as $photo)
                    <div class="list-group-item" 
                         style="width:210px;height:210px;float:left;margin:5px;margin-bottom:60px;background:url({{$photo->url}}) 50%;background-size: cover;border: 2px solid white;">
                        <div class="form-group" style="margin-top:210px;">
                            {{Form::text('photo_names['.$photo->id.']', $photo->name, array('class' => 'form-control'))}}
                        </div>
                    </div>
                @endforeach
            </div>
        {{Form::close()}}
    </div>
</div>
@stop