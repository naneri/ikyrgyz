
@extends('misc.layout')


@section('content')
@include('misc.createnav')
	<div class="container">
		@foreach($topics as $topic)

		<b>{{$topic->title}}</b> <br>
                {{$topic->content}}<br><br>

		@endforeach
	</div>

@stop
