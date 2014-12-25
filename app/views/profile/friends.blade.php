@extends('misc.layout')

@section('content')
	
	@foreach($friends as $friend)
		<a href="{{URL::to('profile/'. $friend->id)}}">{{$friend->email}}</a> |
		<a href="{{URL::to('people/removeFriend/'. $friend->id)}}">remove friend</a>
	@endforeach
@stop