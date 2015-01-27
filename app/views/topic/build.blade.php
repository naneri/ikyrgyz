
@foreach($topics as $topic)

<div class="item" id="topic_{{$topic->id}}">
    user email - {{$topic->user->email}}<br>
    created at - {{$topic->created_at}}<br>
    views - {{$topic->count_read}}<br>
    <a href="#" onclick="comment.show({{$topic->id}});return false;">comments - {{$topic->comments->count()}}</a><br>
    rating - {{$topic->rating}}<br>
    <b>{{$topic->title}}</b> <br>
    {{$topic->description}}<br>
    
    @if ($topic->photoAlbums->count() > 0)
        @foreach($topic->photoAlbums as $photoAlbum)
        {{$photoAlbum->name}}<br>
        @endforeach
    @endif
    
    @if ($topic->photos->count() > 0)
        @foreach($topic->photos as $photo)
        <img src="{{URL::to('/')}}{{$photo->url}}" /><br>
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
    @if(isset($blogInfo))
        blog title - {{HTML::link($topic->blog->getUrl(), $topic->blog->title)}}<br>
        blog topics count - {{$topic->blog->topics->count()}}<br>
    @endif
    <br>
    {{HTML::link('topic/show/'.$topic->id, 'Подробнее', array('id' => 'profile_link'))}}
    <br>
    <br>
</div>
<hr>
@endforeach

@include('comments.scripts')