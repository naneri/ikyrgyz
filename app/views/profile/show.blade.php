@extends('misc.layout')

@section('content')


	{{{$user->email}}} <br>
	<a href="{{URL::to('people/friendRequest/'. $user->id)}}">Стать друзьями</a>
@stop