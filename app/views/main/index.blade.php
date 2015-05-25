@extends('misc.layout')


@section('content')
	@include('scripts.script-topic', array('page' => '/main/ajaxTopics/', 'columnN' => true))
	
    	@include('misc.createnav', compact('topic_number', 'new_messages', 'friend_number'))
    <div class="b-content">
    
    	
        @include('topic.build', array('topics' => $topics, 'blogInfo' => true, 'showCreatePanel' => true))
    </div>
    
    @include('comments.scripts')    
    
@stop
