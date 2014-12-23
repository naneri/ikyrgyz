@extends('misc.layout')

@section('content')

    @include('misc.createnav')
    <div class="container">
        user email - {{$topic->user->email}}<br>
        created at - {{$topic->created_at}}<br>
        views - {{$topic->count_read}}<br>
        comments - {{$topic->comments->count()}}<br>
        rating - {{$topic->rating}}<br>
        <b>{{HTML::link('topic/show/'.$topic->id.'.html', $topic->title, array('id' => 'profile_link'))}}</b> <br>
        {{$topic->description}}<br>
        @if ($topic->type->name == 'image')
        @foreach($topic->images as $image)
        <img src='{{$image->url}}' alt='{{$image->title}}'/>
        @endforeach
        <br>
        @elseif ($topic->type->name == 'video')
        {{$topic->video->embed_code}}<br>
        @endif
        blog title - {{$topic->blog->title}}<br>
        blog topics count - {{$topic->blog->topics->count()}}<br><br>
        @include('comments.show', array('comments' => $topic->comments, 'parent_id' => 0, 'deep' => 0))
    </div>

@stop