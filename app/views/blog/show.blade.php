@extends('misc.layout')

@section('content')
	@foreach($topics as $topic)
		{{$topic->title}} <br>
	@endforeach
	 {{$topics->links()}}
@stop