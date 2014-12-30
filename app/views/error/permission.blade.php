@extends('misc.layout')


@section('content')
<div class="container">
    <p>{{$error}}</p>
    <p>{{HTML::link(URL::previous(), "Back")}}</p>
</div>
@stop


