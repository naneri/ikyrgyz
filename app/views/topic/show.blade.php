@extends('misc.layout')

@section('content')

    @include('misc.createnav')

    <div class="container">
        @if($topic->canEdit())
            {{HTML::link('topic/edit/'.$topic->id, '[Редактировать]')}}
        @endif
        <div class="item" id="topic_{{$topic->id}}">
            user email - {{$topic->user->email}}<br>
            created at - {{$topic->created_at}}<br>
            views - {{$topic->count_read}}<br>
            <a href="#" onclick="comment.show({{$topic->id}});return false;">comments - {{$topic->comments->count()}}</a><br>
            rating - 
            <a href="#" class="comment_vote_up" onclick="topic.vote({{$topic->id}}, 1);return false;">UP</a>
            <span class="rating">{{$topic->rating}}</span>
            <a href="#" class="comment_vote_down" onclick="topic.vote({{$topic->id}}, -1);return false;">DOWN</a><br>
            <b>{{$topic->title}}</b> <br>
            {{$topic->description}}<br>

            @if ($topic->photoAlbums->count() > 0)
                @foreach($topic->photoAlbums as $photoAlbum)
                    {{$photoAlbum->name}}<br>
                @endforeach
            @endif

            @if ($topic->photos->count() > 0)
                @foreach($topic->photos as $photo)
                    <img src="{{$photo->url}}" /><br>
                @endforeach
            @endif

            @if ($topic->audioAlbums->count() > 0)
                @foreach($topic->audioAlbums as $audioAlbum)
                    {{$audioAlbum->name}}<br>
                @endforeach
            @endif

            @if ($topic->audio->count() > 0)
                @foreach($topic->audio as $audio)
                    {{$audio->name}}<br>
                @endforeach
            @endif

            blog title - {{HTML::link('blog/show/'.$topic->blog->id, $topic->blog->title)}}<br>
            blog topics count - {{$topic->blog->topics->count()}}<br>
            <br>
            <div class="comments" id="comments">
                @include('comments.build', array('topic' => $topic))
                @include('comments.scripts')
            </div>
            <br>
            <br>
        </div>
    </div>

@stop

@include('topic.scripts-ajax')