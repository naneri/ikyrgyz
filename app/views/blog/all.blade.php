@extends('misc.layout')

@section('content')
		<div class="container">
		    @foreach($blogs as $blog)
		        {{HTML::link('blog/show/'.$blog->id, $blog->title)}} <br>
		    @endforeach

                    {{$blogs->links()}}
		</div>
@stop