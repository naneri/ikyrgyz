

<div class="masonry">
    @foreach($topics as $topic)
  
    <div class="b-user-wall">
      <div class="b-user-wall__inner">
        <div class="b-user-wall-header">
          <div class="b-user-wall-header__image"><a href="{{URL::to('profile/'.$topic->user->id)}}"><img src="{{ $topic->user->description->user_profile_avatar or ''}}" alt=""/></a></div>
          <p class="b-user-wall-header__title"><a href="{{ URL::to('topic/show/'. $topic->id) }}">{{$topic->title}}</a></p>
          <p class="b-user-wall-header__date">{{$topic->created_at}}
            <div class="clear"></div>
          </p>
          <!--<p class="b-user-wall-header__vision">
            <img src="{{ asset('img/22.png') }}" alt=""/><span>19</span>
            <img src="{{ asset('img/23.png') }}" alt=""/><span>34</span>
          </p> -->
        </div>
        <div class="b-user-wall-image">
          @if($topic->image_url)
            <a href="{{ URL::to('topic/show/'. $topic->id) }}"><img src="{{$topic->image_url}}" alt=""></a>
          @endif
          <div class="topic-preview-text">
            {{mb_substr(strip_tags($topic->description), 0 ,200, 'UTF-8') }}
          </div>
        </div>
        <div class="b-user-wall-footer">
            <div class="b-user-wall-footer__image b-user-wall-header__image"><img src="{{ asset(($topic->blog->avatar)?$topic->blog->avatar:'img/48.png') }}" class="blog-avatar" alt=""/></div>
          <p class="b-user-wall-footer__title">{{HTML::link('blog/show/'.$topic->blog->id, $topic->blog->title, array('class' => 'b-user-wall-footer__title'))}}</p>
          <?php $blogTopicsCount = $topic->blog->topics->count(); ?>
          <p class="b-user-wall-footer__number">{{$blogTopicsCount}}
                @if($blogTopicsCount == 1)
                    топик
                @elseif($blogTopicsCount > 1 && $blogTopicsCount < 5)
                    топика
                @else
                    топиков
                @endif
            <div class="clear"></div>
          </p>
          <div class="b-user-wall-footer__btn"><a href="{{ URL::to('topic/show/'. $topic->id) }}" class="about-btn btn">Подробнее</a>
            <ul class="b-user-wall-footer-list">
              <li><a href="" class="share-btn btn">Поделиться</a>
                <ul class="b-user-wall-footer-dropdown">
                  <li><a href="{{ Share::load(URL::to('topic/show/'. $topic->id), $topic->description)->facebook()  }}">Facebook</a></li>
                  <li><a href="{{ Share::load(URL::to('topic/show/'. $topic->id), $topic->description)->gplus()  }}">Google+</a></li>
                  <li><a href="{{ Share::load(URL::to('topic/show/'. $topic->id), $topic->description)->twitter()  }}">Twitter</a></li>
                  <li><a href="{{ 'http://connect.mail.ru/share?share_url='.URL::to("topic/show/". $topic->id).'&title='.htmlspecialchars($topic->description)}}">Мой мир</a></li>
                  <li><a href="{{ Share::load(URL::to('topic/show/'. $topic->id), $topic->description)->vk()  }}">В контакте</a></li>
                </ul>
              </li>
            </ul>
            <input type="submit" onclick="return vote.topic({{$topic->id}},-1);" class="btn btn-minus"/>
            <input type="submit" onclick="return vote.topic({{$topic->id}},1);" class="btn btn-plus"/><span class="likes" id="rating_topic_{{$topic->id}}">{{round($topic->rating,2)}}</span>
          </div>
        </div>
      </div>
    </div>

    @endforeach
</div>

