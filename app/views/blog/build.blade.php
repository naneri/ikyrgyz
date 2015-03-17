<div class="masonry">
	@foreach($blogs as $blog)
	<div class="b-user-blog">
            <div class="b-user-blog__inner">
              <div class="b-user-blog-header">
                <div class="b-user-blog-header__top">
                  <p class="b-user-blog-header__title"><a href="{{ URL::to('blog/show') . '/' . $blog->id }}">{{$blog->title}}</a></p>
                  <div class="b-user-blog-header__vision">
                    <!--<img src="img/62.png" alt="vision"/><span>99</span>
                    <img src="img/63.png" alt="vision"/><span>34</span> -->
                  </div>
                </div>
                <div class="b-user-blog-header__bot">
                  <p class="b-user-blog-header__date">{{$blog->created_at}}</p>
                 <!-- <p class="b-user-blog-header__tags">Бурана, Кыргызстан, Древняя архитектура, Моя родина</p> -->
                </div>
              </div>
              <div class="b-user-blog-image">
                @if(isset($blog->avatar))
                <a href="#">
                  <a href="{{ URL::to('blog/show') . '/' . $blog->id }}"><img src="{{$blog->avatar}}" alt="blog-image"/></a>
                </a>
                @endif
              </div>
              <div class="b-user-blog-footer">
                <div class="b-user-blog-footer__btn"><a href="{{ URL::to('blog/show') . '/' . $blog->id }}" class="about-btn btn">Подробнее</a>
                  <input type="submit" value="Подписаться" class="button-default btn-follow"/>
                  <ul class="b-user-wall-footer-list">
                    <li><a href="" class="share-btn btn">Поделиться</a>
                      <ul class="b-user-wall-footer-dropdown">
                        <li><a href="">Facebook</a></li>
                        <li><a href="">Google+</a></li>
                        <li><a href="">Twitter</a></li>
                        <li><a href="">Мой мир</a></li>
                        <li><a href="">В контакте</a></li>
                      </ul>
                    </li>
                  </ul>
                  <input type="submit" class="btn btn-minus"/>
                  <input type="submit" class="btn btn-plus"/><span class="likes">{{$blog->rating}}</span>
                </div>
              </div>
            </div>
          </div>
	@endforeach
</div>