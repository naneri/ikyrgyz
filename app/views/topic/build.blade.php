

<div class="masonry">
    @foreach($topics as $topic)
  
    <div class="b-user-wall">
      <div class="b-user-wall__inner">
        <div class="b-user-wall-header">
          <div class="b-user-wall-header__image"><a href=""><img src="{{ $topic->user->description->user_profile_avatar or ''}}" alt=""/></a></div>
          <p class="b-user-wall-header__title">{{$topic->title}}</p>
          <p class="b-user-wall-header__date">{{$topic->created_at}}
            <div class="clear"></div>
          </p>
          <!--<p class="b-user-wall-header__vision">
            <img src="{{ asset('img/22.png') }}" alt=""/><span>19</span>
            <img src="{{ asset('img/23.png') }}" alt=""/><span>34</span>
          </p> -->
        </div>
        <div class="b-user-wall-image">
          @if(isset($topic->image_url))
            <a href=""><img src="{{$topic->image_url}}" alt=""></a>
          @endif
          {{substr(strip_tags($topic->description), 0 ,200) }}
        </div>
        <div class="b-user-wall-footer">
          <div class="b-user-wall-footer__image"><a href=""><img src="{{ asset('img/48.png') }}" alt=""/></a></div>
          <p class="b-user-wall-footer__title">{{$topic->blog->title}}</p>
          <p class="b-user-wall-footer__number">31 топик
            <div class="clear"></div>
          </p>
          <div class="b-user-wall-footer__btn"><a href="{{ URL::to('topic/show/'. $topic->id) }}" class="about-btn btn">Подробнее</a>
            <ul class="b-user-wall-footer-list">
              <li><a href="" class="share-btn btn">Поделиться</a>
                <ul class="b-user-wall-footer-dropdown">
                  <li><a href="{{ Share::load(URL::to('topic/show/'. $topic->id), $topic->description)->facebook()  }}">Facebook</a></li>
                  <li><a href="{{ Share::load(URL::to('topic/show/'. $topic->id), $topic->description)->gplus()  }}">Google+</a></li>
                  <li><a href="{{ Share::load(URL::to('topic/show/'. $topic->id), $topic->description)->twitter()  }}">Twitter</a></li>
                  <li><a href="http://connect.mail.ru/share?share_url={{ URL::to('topic/show/'. $topic->id) }}&title={{ $topic->description }}">Мой мир</a></li>
                  <li><a href="{{ Share::load(URL::to('topic/show/'. $topic->id), $topic->description)->vk()  }}">В контакте</a></li>
                </ul>
              </li>
            </ul>
            <input type="submit" onclick="return vote.topic({{$topic->id}},2);" class="btn btn-minus"/>
            <input type="submit" class="btn btn-plus"/><span class="likes">+99</span>
          </div>
        </div>
      </div>
    </div>

    @endforeach
</div>

