
@extends('misc.layout')


@section('content')
@include('misc.createnav')
	<div class="container">
		@foreach($topics as $topic)

		{{$topic->title}} <br>

		@endforeach
	</div>

@stop
