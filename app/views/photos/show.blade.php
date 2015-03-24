@extends('misc.layout')
@section('content')
{{HTML::style('css/bootstrap.css')}}
<div class="container">
    <div class="col-md-12">
        <div class="panel panel-default" style="height: 40px; padding:0 20px;">
            <h4 style="float: left;">{{$photo->name}}</h4>
            <!--span style="float: right;line-height: 38px;"><a href="">Загрузить</a></span-->
        </div>
        <div>
            {{HTML::image($photo->url)}}
        </div>
    </div>
</div>
@stop