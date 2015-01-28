 <div class="b-section-wall">
          <div class="b-section-wall__left">
            @foreach($topics as $topic)
            <div class="b-section-wall__inner">
              <div class="b-section-wall__top"><a href="#"><img src="{{ asset('img/content/user-name.png') }}" alt=""/></a>
                <p class="title">{{$topic->title}}</p>
                <p class="date">{{$topic->created_at}}</p>
                <p class="last"> <span class="vis">19 </span><span class="msg">34</span></p>
                <div class="clear"></div>
              </div>
              
            @if ($topic->photos->count() > 0)
                @foreach($topic->photos as $photo)
                <div class="b-section-wall__image">
                    <a href="#"><img src="{{URL::to($photo->url)}}" alt=""/></a>
                </div>
                @endforeach
            @endif
              <div class="b-section-wall__bottom"><img src="{{ asset('img/content/user-name.png') }}" alt=""/>
                <p class="title">Красота кыргызского народа</p>
                <p class="topic">31 топик</p>
                <div class="clear"></div>
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
                  <input type="submit" class="minus"/>
                  <input type="submit" class="plus"/><span class="like">+99</span>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          
          </div>
          <div class="clear"></div>
        </div>
<!--
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
-->
@include('comments.scripts')