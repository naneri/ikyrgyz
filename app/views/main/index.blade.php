
@extends('misc.layout')


@section('content')
    @include('misc.createnav')
    <div class="">
        <div class="b-section-wall">
            <div class="b-section-wall__left all_topics">
                @include('topic.build', array('topics' => $topics, 'blogInfo' => true))
            </div>
            <div class="clear"></div>
        </div>
    </div>
    @include('main.scripts')
@stop
