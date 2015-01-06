@foreach($topics as $topic)
<div class="item">
    user email - {{$topic->user->email}}<br>
    created at - {{$topic->created_at}}<br>
    views - {{$topic->count_read}}<br>
    comments - {{$topic->comments->count()}}<br>
    rating - {{$topic->rating}}<br>
    <b>{{HTML::link('topic/show/'.$topic->id, $topic->title, array('id' => 'profile_link'))}}</b> <br>
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
    
    @if($blogInfo)
        blog title - {{HTML::link('blog/show/'.$topic->blog->id, $topic->blog->title)}}<br>
        blog topics count - {{$topic->blog->topics->count()}}<br>
    @endif
    <br>
</div>
@endforeach