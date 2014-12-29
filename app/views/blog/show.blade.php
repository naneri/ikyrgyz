@extends('misc.layout')

@section('content')
@include('misc.createnav')
<div class="container">
    <h3>{{$blog->title}}</h3>
    <p>{{$blog->description}}</p>

    @include('topic.build', array('topics' => $topics))
</div>
@stop
