@extends('misc.layout')

@section('content')

	<div class="container">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<h2>Новые сообщения</h2><br>
			@foreach($messages as $message)
				{{$message->email}} | 
				{{$message->text}}
				<br>
			@endforeach
		</div>
		<div class="col-md-4"></div>
	</div>
@stop