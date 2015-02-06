

@foreach($topics as $topic)

<div class="col-lg-6">
  <div class="b-wall-top">
  <p class="top-inner"><a href=""><img src="img/20.png" alt="" class="pull-left"/></a><span class="wall-top-name">Бурана</span><span class="wall-top-date">17 июня 2014, 12:51</span></p>
  <div class="top-count"><img src="img/22.png" alt=""/><span>19</span><img src="img/23.png" alt=""/><span>34</span></div>
  </div>
  <div class="b-wall-image"><a href="#"><img src="img/21.png" alt=""/></a></div>
  <div class="b-wall-bot">
  <p class="bot-inner"><a href="" class="bot-image"><img src="img/20.png" alt="" class="pull-left"/></a><span class="bot-name-title">Красота Кыргызского народа</span><span class="bot-count-title">31 топик</span>
  <div class="clear"></div>
  </p>
    <ul class="nav nav-pills">
      <li><a href="" class="about">Подробнее</a></li>
      <li class="dropdown share-list-dropdown"><a href="" class="share">Поделиться</a>
        <ul class="dropdown-menu">
          <li><a href=""></a></li>
          <li><a href=""></a></li>
          <li><a href=""></a></li>
          <li><a href=""></a></li>
          <li><a href=""></a></li>
        </ul>
        </li>
      <li class="btn-list"><a href="" class="btn"></a></li>
      <li class="btn-list"><a href="" class="btn"></a></li>
      <li>+99</li>
    </ul>
  </div>
</div>

@endforeach

            <!-- 

 <div class="b-section-wall__inner">
              <div class="b-section-wall__top"><a href="#"><img src="{{ $topic->user->description->user_profile_avatar or ''}}" alt=""/></a>
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
                <p class="title">{{$topic->blog->title}}</p>
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
          -->
          
<!--
=======
>>>>>>> c1e754593428d6e4a0b92e9f3879c3c11a726cf2
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
<<<<<<< HEAD
-->
