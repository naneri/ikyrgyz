@extends('misc.layout')

@section('content')

    <div class="b-wrapper" id="topic_{{$topic->id}}">
        <div class="b-page">
            <div class="b-content">
          <div class="b-profile-about">
            <div class="b-profile-about__inner">
              <div class="b-profile-about__title">
                <div class="b-profile-about-title">
                  <p class="b-profile-about-title__title">{{$topic->title}}</p>
                  <div class="b-profile-about-title__right"><span class="date">{{$topic->created_at}}</span>
                    @if($topic->canEdit())
                      <a href="{{ URL::to('/topic/edit/' . $topic->id) }}"><input type="submit" value="Редактировать" class="btn-edit button-default"/></a>
                      <a href="{{ URL::to('/topic/delete/' . $topic->id) }}"><input type="submit" value="Удалить" class="btn-delete button-default"/></a>
                    @endif
                    <!--<img src="{{ asset('img/22.png') }}" alt="vision"/>
                    <span class="count">19</span>
                    <img src="{{ asset('img/23.png') }}" alt="vision"/>
                    <span class="count">34</span> -->
                  </div>
                  <div class="clear"></div>
                </div>
              </div>
              <div class="b-profile-about__profile">
                <div class="b-profile-about-profile"><span class="author">Автор</span><a href="#">
                    @if(isset($creator->description->user_profile_avatar))
                        <img style="width:40px" src="{{$creator->description->user_profile_avatar}}" alt="" class="b-profile-about-profile__image"/>
                    @else
                        <img src="{{ asset('img/48.png') }}" alt="" class="b-profile-about-profile__image"/>
                    @endif
                </a>
                  <p class="b-profile-about-profile__name">{{@$creator->description->first_name . ' '. @$creator->description->last_name}}</p>
                  <div class="b-profile-about-profile__buttons">  
                    @if($creator->id !== $user_data->id)                                  
                      <input type="submit" value="Профиль" class="input-default btn-profile"/>
                      <a href="{{ URL::to('people/friendRequest/'. $creator->id)}}">
                          <input type="submit" value="Дружить" class="input-default btn-friend"/>
                      </a>
                    @endif
                    <span class="rating-text">Рейтинг: <span class="rating-num">+0.00</span></span>
                  </div>
                  <div class="clear"></div>
                </div>
              </div>
              <div class="b-profile-about__text">
                <div class="b-profile-about-text topic-description">
                    @if(isset($topic->image_url))
                        <img src="{{$topic->image_url}}" alt="" class="b-profile-about-text__image"/>
                    @else
                        <img src="{{ asset('img/55.png') }}" alt="" class="b-profile-about-text__image"/>
                    @endif
                  <p class="b-profile-about-text__text">
                    {{$topic->description}}
                  </p>
                  <div class="clear"></div>
                </div>
              </div>
              
              <div class="b-profile-about__tags">
                <div class="b-profile-about-tags">
                    <p class="b-profile-about-tags__title">Теги: {{$topic->tagsToString()}}</p>
                  <div class="b-profile-about-tags__user">
                    <div class="b-profile-about-tags-user">
                      <div class="b-profile-about-tags-user__left"><span class="b-profile-about-tags-user__name">Блог</span><img src="{{ $blog->avatar() }}" alt="" class="b-profile-about-tags-user__image blog-avatar"/>
                        <p class="b-profile-about-tags-user__title">{{$blog->title}}</p>
                        <div class="b-profile-about-tags-user__buttons">
                            <a href="{{URL::to('blog/show/'.$blog->id)}}"><button class="btn-default btn-view">Просмотреть</button></a>
                            <a href="{{URL::to('blog/'.$blog->id.'/read')}}"><button class="btn-default btn-follow">Подписаться</button></a>
                            <span class="count-topic">{{$blog->topics->count()}} топиков</span><span class="count-followers">{{$blog->getBlogUsers()->count()}} подписчиков</span>
                        </div>
                      </div>
                      <div class="b-profile-about-tags-user__right">
                        <ul class="b-profile-about-tags-user-list dropdown">
                          <li><a href="" class="share-btn btn"></a>
                            <ul class="b-profile-about-tags-user-list-dropdown sub-dropdown">
                              <li><a href="">Facebook</a></li>
                              <li><a href="">Google+</a></li>
                              <li><a href="">Twitter</a></li>
                              <li><a href="">Мой мир</a></li>
                              <li><a href="">В контакте</a></li>
                            </ul>
                          </li>
                        </ul>
                          <input type="submit" class="btn btn-minus" onclick="return vote.topic({{$topic->id}},-1);"/>
                          <input type="submit" class="btn btn-plus" onclick="return vote.topic({{$topic->id}},1);" /><span class="likes" id="rating_topic_{{$topic->id}}">{{round($topic->rating,2)}}</span>
                      </div>
                      <div class="clear"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                  <div class="b-profile-about-profile__name" style="height: 20px;">
                      <div style="float:left;">Комментарии {{$topic->comments->count()}}</div>
                      <div style="float:right;">Сортировка: {{Form::select('sort_by', array('old' => 'Старые', 'new' => 'Новые', 'rating' => 'По рейтингу'))}}</div>
                  </div>
                  <hr>
                  <br>
                  <div style="height:50px;">
                        {{HTML::image(Auth::user()->avatar(), '', array('style' => 'float:left;width:40px;height:40px;margin-right:10px;'))}}
                        <span style="line-height: 40px;" class="b-profile-about-profile__name"> {{Auth::user()->getNames()}}</span>
                  </div>
                  <div id="add_comment_0">
                      {{Form::textarea('comment', null, array('class' => 'add_comment_text'))}}
                      <input type="button" value="Опубликовать" class="default-button submit-button" onclick="comment.submit(0,{{$topic->id}});">
                  </div>
                  <div id="comments_child_0">
                    @include('comments.build', array('comments' => $comments, 'isModerator' => $isModerator, 'parent' => null, 'sort' => $commentsSort))
                  </div>
                @include('comments.scripts')
              </div>
            </div>
          </div>
        </div>
        </div>
    </div>
<script>
$(document).ready(function(){
    comment.convertTimes('body');
    comment.initEditor("textarea.add_comment_text");
    $('select[name="sort_by"]').change(function(){
        comment.sort({{$topic->id}}, $(this).val());
    });
});
</script>
@stop