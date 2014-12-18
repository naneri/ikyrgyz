@extends('misc.layout')

@section('content')

{{Session::get('message')}}<br>
	{{{$user->email}}} <br>
	<a href="{{URL::to('people/friendRequest/'. $user->id)}}">Стать друзьями</a>
@stop