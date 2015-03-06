@extends('misc.layout')

@section('content')

    <div class="b-wrapper">
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
                <div class="b-profile-about-text">
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
                  <p class="b-profile-about-tags__title">Теги: Тег номер один,  Тег номер два, Тег номер три, и так далее</p>
                  <div class="b-profile-about-tags__user">
                    <div class="b-profile-about-tags-user">
                      <div class="b-profile-about-tags-user__left"><span class="b-profile-about-tags-user__name">Блог</span><img src="{{ asset('img/48.png') }}" alt="" class="b-profile-about-tags-user__image"/>
                        <p class="b-profile-about-tags-user__title">{{$blog->title}}</p>
                        <div class="b-profile-about-tags-user__buttons">
                          <button class="btn-default btn-view">Просмотреть</button>
                          <button class="btn-default btn-follow">Подписаться</button><span class="count-topic">999 топиков</span><span class="count-followers">57 подписчиков</span>
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
                        <input type="submit" class="btn btn-minus"/>
                        <input type="submit" class="btn btn-plus"/><span class="likes">+99</span>
                      </div>
                      <div class="clear"></div>
                    </div>
                  </div>
                </div>
              </div>
              <!--<div class="b-profile-about__topics">
                <div class="b-profile-about-topics">
                  <p class="b-profile-about-topics__title">Новые топики в блоге</p>
                  <ul class="b-profile-about-topics-list">
                    <li class="b-profile-about-topics-list__list">
                      <p class="b-profile-about-topics-list__text">В верстке имени топика нужно учесть, что имя топика может состоять из длинного названия в 3 ряда</p>
                      <div class="b-profile-about-topics-list__image"><a href=""><img src="img/59.png" alt=""/></a></div>
                    </li>
                    <li class="b-profile-about-topics-list__list">
                      <p class="b-profile-about-topics-list__text">В верстке имени топика нужно учесть, что имя топика может состоять из длинного названия в 3 ряда</p>
                      <div class="b-profile-about-topics-list__image"><a href=""><img src="img/59.png" alt=""/></a></div>
                    </li>
                    <li class="b-profile-about-topics-list__list">
                      <p class="b-profile-about-topics-list__text">В верстке имени топика нужно учесть, что имя топика может состоять из длинного названия в 3 ряда</p>
                      <div class="b-profile-about-topics-list__image"><a href=""><img src="img/59.png" alt=""/></a></div>
                    </li>
                    <li class="b-profile-about-topics-list__list">
                      <p class="b-profile-about-topics-list__text">В верстке имени топика нужно учесть, что имя топика может состоять из длинного названия в 3 ряда</p>
                      <div class="b-profile-about-topics-list__image"><a href=""><img src="img/59.png" alt=""/></a></div>
                    </li>
                    <li class="b-profile-about-topics-list__list">
                      <p class="b-profile-about-topics-list__text">В верстке имени топика нужно учесть, что имя топика может состоять из длинного названия в 3 ряда</p>
                      <div class="b-profile-about-topics-list__image"><a href=""><img src="img/59.png" alt=""/></a></div>
                    </li>
                    <div class="clear"></div>
                  </ul>
                </div>
              </div> -->
              <div class="b-profile-about__form">
                <div class="b-profile-about-form">
                  {{Form::open(array('url' =>  URL::to('topic/comment/add') ))}}
                    <div class="b-profile-about-form__item"><a href="">
                        @if(isset($user_data->description->user_profile_avatar))
                            <img style="width:40px"src="{{ asset($user_data->description->user_profile_avatar) }}" alt="" class="b-profile-about-form__image"/>
                        @else
                            <img src="{{ asset('img/48.png') }}" alt="" class="b-profile-about-form__image"/>
                        @endif
                    </a>
                      <p class="b-profile-about-form__title">{{@$user_data->description->first_name . ' '. @$user_data->description->last_name}}</p>
                      <div class="clear"></div>
                    </div>
                    <div class="b-profile-about-form__item">
                      <div class="b-profile-about-form__inner">
                        <textarea name="" cols="30" rows="10" class="add-comment">Добавить комметарии</textarea>
                      </div>
                    </div>
                    <div class="b-profile-about-form__item">
                      <input type="submit" value="Отмена" class="default-button cancel-button"/>
                      <input type="submit" value="Опубликовать" class="default-button submit-button"/>
                    </div>
                  {{Form::close()}}
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
    </div>


 <!--   <div class="container">
        @if($topic->canEdit())
            {{HTML::link('topic/edit/'.$topic->id, '[Редактировать]')}}
        @endif
        <div class="item" id="topic_{{$topic->id}}">
            user email - {{$topic->user->email}}<br>
            created at - {{$topic->created_at}}<br>
            views - {{$topic->count_read}}<br>
            <a href="#" onclick="comment.show({{$topic->id}});return false;">comments - {{$topic->comments->count()}}</a><br>
            rating - 
            <a href="#" class="comment_vote_up" onclick="vote.topic({{$topic->id}}, 1);return false;">UP</a>
            <span class="rating" id="rating_topic_{{$topic->id}}">{{$topic->rating}}</span>
            <a href="#" class="comment_vote_down" onclick="vote.topic({{$topic->id}}, -1);return false;">DOWN</a><br>
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

            blog title - {{HTML::link('blog/show/'.$blog->id, $blog->title)}}<br>
            blog topics count - {{$blog->topics->count()}}<br>
            <br>
            <div class="comments" id="comments">
                @include('comments.build', array('topic' => $topic))
                @include('comments.scripts')
            </div>
            <br>
            <br>
        </div>
    </div> -->

@stop