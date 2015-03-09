@extends('misc.layout')


@section('content')
            <div class="b-content">
            	@include('misc.createnav')
                @include('topic.build', array('topics' => $topics, 'blogInfo' => true))
            </div>    
@stop
