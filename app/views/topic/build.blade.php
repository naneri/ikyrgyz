@foreach($topics as $topic)
<div class="b-section-wall__inner" id="topic_{{$topic->id}}">
  <div class="b-section-wall__top">
    <a href="{{URL::to('profile/'.$topic->user->id)}}"><img src="{{ asset('img/content/user-name.png') }}" alt=""/></a>
    <p class="title"><a href="{{ URL::to('topic/show/'.$topic->id) }}">{{$topic->title}}</a></p>
    <p class="date">{{$topic->created_at}}</p>
    <p class="last">
        <span class="vis">{{$topic->count_read}}</span>
        <span class="msg"><a href="#" onclick="comment.show({{$topic->id}});return false;">{{$topic->comments->count()}}</a></span></p>
    <div class="clear"></div>
  </div>

@if ($topic->photos->count() > 0)
    @foreach($topic->photos as $photo)
    <div class="b-section-wall__image">
        <a href="#"><img src="{{URL::to($photo->url)}}" alt=""/></a>
    </div>
    @endforeach
@endif
<div class="b-section-wall__bottom">
    @if(isset($blogInfo) && $blogInfo)
        <img src="{{ asset(($topic->blog->type->name=='personal' || $topic->blog->image == '')?'img/content/avatar_blog_48x48.png':$topic->blog->image) }}" alt=""/>
        <p class="title">{{HTML::link('blog/show/'.$topic->blog->id, $topic->blog->title)}}</p>
        <p class="topic">{{$topic->blog->topics->count()}} топик</p>
        <div class="clear"></div>
    @endif
    <div class="btn-wrapper"><a href="{{ URL::to('topic/show/'.$topic->id) }}" class="about">Подробнее</a>
      <ul class="share-dropdown">
        <li><a href="#" class="share"></a>
          <ul class="dropit-submenu">
            <li><a href="#"> <span class="soc item1"></span><span class="title">Facebook</span></a></li>
            <li><a href="#"> <span class="soc item2"></span><span class="title">Facebook</span></a></li>
            <li><a href="#"> <span class="soc item3"></span><span class="title">Facebook</span></a></li>
            <li><a href="#"> <span class="soc item4"></span><span class="title">Facebook</span></a></li>
            <li><a href="#"> <span class="soc item5"></span><span class="title">Facebook</span></a></li>
          </ul>
        </li>
      </ul>
      <input type="submit" class="minus" onclick="vote.topic({{$topic->id}}, -1);return false;" />
      <input type="submit" class="plus"  onclick="vote.topic({{$topic->id}}, 1);return false;"/>
      <span class="like" id="rating_topic_{{$topic->id}}">{{$topic->rating}}</span>
    </div>
  </div>
</div>
@endforeach

@section('scripts')
    @include('comments.scripts')
@stop