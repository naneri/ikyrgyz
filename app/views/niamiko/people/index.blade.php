@extends("{$template}misc.layout")

@section('content')

	@foreach($users as $user)
		{{$user->email}} 
		<a href="{{URL::to('profile/'.$user->id)}}">link</a>
		<br>
	@endforeach
@stop