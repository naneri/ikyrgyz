@extends('misc.layout')

@section('content')

    @include('misc.createnav')

    <div class="container">
        <input type="hidden" value="{{$topic->id}}" id="topic_id">
        @if($topic->canEdit())
            {{HTML::link('topic/edit/'.$topic->id, '[Редактировать]')}}
        @endif
        @include('topic.build', array('topics' => array($topic), 'blogInfo' => true))
        <div class="comments" id="comments">
            @include('comments.build', array('comments' => $topic->comments, 'parent_id' => 0, 'with_child' => true))
            @include('comments.scripts')
        </div>
    </div>

@stop