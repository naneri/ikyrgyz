@extends('misc.layout')


@section('content')
	@include('main.scripts')
	
    <div class="b-content">
    	@include('misc.createnav')
        @include('topic.build', array('topics' => $topics, 'blogInfo' => true))
    </div>
    
    @include('comments.scripts')    
    
@stop
