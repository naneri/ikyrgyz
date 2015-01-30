@extends('misc.layout')


@section('content')
	@include('misc.createnav')
	<div class="container all_topics">
	    @include('topic.build', array('topics' => $topics, 'blogInfo' => true))
	</div>
@stop

@section('scripts')
	@include('main.scripts')
@stop