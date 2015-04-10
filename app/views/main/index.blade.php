@extends('misc.layout')


@section('content')
	@include('scripts.script-topic', array('page' => '/main/ajaxTopics/', 'columnN' => true))
	
    <div class="b-content">
    	@include('misc.createnav')
        @include('topic.build', array('topics' => $topics, 'blogInfo' => true))
    </div>
    
    @include('comments.scripts')    
    
@stop
