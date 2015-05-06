@extends('misc.layout')


@section('content')
	@include('scripts.script-topic', array('page' => '/main/ajaxTopics/', 'columnN' => true))
	
    	@include('misc.createnav')
    <div class="b-content">
    
    	
        @include('topic.build', array('topics' => $topics, 'blogInfo' => true))
    </div>
    
    @include('comments.scripts')    
    
@stop
