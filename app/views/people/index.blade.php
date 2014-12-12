@extends('misc.layout')

@section('content')

	@foreach($users as $user)
		{{$user->email}} <br>
	@endforeach
@stop