@extends('misc.layout')

@section('content')
		<div class="container">
		    @foreach($blogs as $blog)
		        {{$blog->title}} <br>
		    @endforeach
		</div>

		{{$blogs->links()}}
@stop