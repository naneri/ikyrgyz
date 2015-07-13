@extends('misc.layout')
@section('content')
{{HTML::style('css/bootstrap.css')}}
<div class="container">
    <div class="col-md-12">
        <div class="panel panel-default" style="height: 40px; padding:0 20px;">
            <h4 style="float: left;">
                <a href="{{URL::to('profile/'.$photo->album->user->id)}}">{{$photo->album->user->getNames()}}</a> →
                <a href="{{URL::to('profile/'.$photo->album->user->id.'/photos')}}">{{ trans('network.photoalbums') }}</a> →
                <a href="{{URL::to('photoalbum/'.$photo->album->id)}}">{{$photo->album->name}}</a> →
                {{$photo->name}}
            </h4>
            @if($photo->canEdit())
                <span style="float: right;line-height: 38px;">
                    <a href="{{URL::to('photo/'.$photo->id.'/delete')}}">{{ trans('network.delete') }}</a> |
                    <a href="{{URL::to('photo/'.$photo->id.'/edit')}}">{{ trans('network.change') }}</a>
                </span>
            @endif
        </div>
        <div>
            {{HTML::image($photo->url, null, array('style' => 'max-width:1110px;'))}}
        </div>
    </div>
</div>
@stop