@extends('misc.layout')

@section('content')

	@include('blog.scripts')
   	<div class="b-content">
    	@include('misc.createnav')
    	@include('blog.build', array('blogs' => $blogs))

	</div>
@stop