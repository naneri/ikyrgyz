@extends('misc.layout')


@section('content')
	@include('misc.createnav')
	 	<div class="b-section-wall">
          	<div class="b-section-wall__left">
	    		@include('topic.build', array('topics' => $topics, 'blogInfo' => true))
			</div>
          	<div class="clear"></div>
        </div>
    @include('comments.scripts')    
@stop

@section('scripts')
	@include('main.scripts')
@stop