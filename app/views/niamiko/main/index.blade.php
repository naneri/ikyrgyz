@extends("{$template}misc.layout")


@section("content")
	@include("scripts.script-topic", array('page' => '/main/ajaxTopics/', 'columnN' => true))
	
    	@include("{$template}misc.createnav", compact('topic_number', 'new_messages', 'friend_number'))
    <div class="b-content">
    
    	
        @include("{$template}topic.build", array('topics' => $topics, 'blogInfo' => true, 'showCreatePanel' => true))
    </div>
    
    @include("{$template}comments.scripts")    
    
@stop
