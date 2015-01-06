@extends('misc.layout')

@section('content')

    @include('misc.createnav')

    <div class="container">
        @if($topic->canEdit())
            {{HTML::link('topic/edit/'.$topic->id, '[Редактировать]')}}
        @endif
        @include('topic.build', array('topics' => array($topic), 'blogInfo' => true))
    </div>

@stop