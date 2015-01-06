@extends('misc.layout')

@section('content')
	<div class="container">
		<b>Отправитель: </b><br>
		{{$message->email}} <br>
		<b>Текст:</b>	<br>
		{{$message->text}}
	</div>
@stop