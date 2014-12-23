@extends('misc.layout')

@section('content')
	
	@foreach($friends as $friend)
		<p>{{$friend->email}}</p>
	@endforeach
@stop