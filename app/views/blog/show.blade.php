@extends('misc.layout')

@section('content')

   	<div class="b-content">
    	@include('misc.createnav')
    	@include('topic.build', array('topics' => $topics))

	</div>

	@include('scripts.script-topic', array('page' => '/blog/showAjax/' . $blog->id , 'no_sorting' => true))	
@stop