@extends('misc.layout')

@section('content')

    @include('misc.createnav')

    <div class="container">
        <input type="hidden" value="{{$topic->id}}" id="topic_id">
        @if($topic->canEdit())
            {{HTML::link('topic/edit/'.$topic->id, '[Редактировать]')}}
        @endif
        @include('topic.build', array('topics' => array($topic), 'blogInfo' => true))

        <a href="#" onclick="comment.addForm(0)">Add comment</a>
        <div class="comment_body" id="comment_body_0"></div>
        @include('comments.show', array('comments' => $topic->comments, 'parent_id' => 0))
        @include('comments.scripts')
    </div>

@stop