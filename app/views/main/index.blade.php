@extends('misc.layout')


@section('content')
    @include('misc.createnav')
            <div class="container b-main-topic-wrapper all_topics">
                @include('topic.build', array('topics' => $topics, 'blogInfo' => true))
            </div>
    @include('main.scripts')
    @include('comments.scripts')    
@stop
