@extends('misc.layout')
@section('content')
{{HTML::style('css/bootstrap.css')}}
<div class="container">
    <div class="col-md-12">
        <div class="panel panel-default" style="height: 40px; padding:0 20px;">
            <h4 style="float: left;">
                <a href="{{URL::to('profile/'.$audio->album->user->id)}}">{{$audio->album->user->getNames()}}</a> →
                <a href="{{URL::to('profile/'.$audio->album->user->id.'/audios')}}">Аудиоальбомы</a> →
                <a href="{{URL::to('audioalbum/'.$audio->album->id)}}">{{$audio->album->name}}</a> →
                {{$audio->name}}
            </h4>
            @if($audio->canEdit())
                <span style="float: right;line-height: 38px;">
                    <a href="{{URL::to('audio/'.$audio->id.'/delete')}}">Удалить</a> |
                    <a href="{{URL::to('audio/'.$audio->id.'/edit')}}">Изменить</a>
                </span>
            @endif
        </div>
        <div>
            <a href="{{$audio->url}}">
                {{$audio->name}}
            </a>
        </div>
    </div>
</div>
@stop