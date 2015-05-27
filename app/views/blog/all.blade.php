@extends('misc.layout')

@section('content')

	@include('scripts.script-topic', array('page' => 'blog'))
   	<div class="b-content">
    	@include('misc.createnav')
    	@include('blog.build', array('blogs' => $blogs))

	</div>
@stop