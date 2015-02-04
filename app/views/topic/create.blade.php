@extends('misc.layout')

@section('content')

    @include('misc.createnav')
    <div class="b-add-topic">
    <div class="container">
      <form id="" method="" action="">
        <p class="title">Создать топик<span class="close-topic btn pull-right"></span></p>
        <div class="b-wrapper">
          <input value="Введите название" type="text" class="topic-add-name"/><a href="#" class="pull-right"><span>Черновики 999</span></a>
          <div class="topic-select-blog">
            <select name="">
              <option value="">Выберете блог</option>
              <option value=""></option>
              <option value=""></option>
            </select><span class="btn skin-topic-btn">Обложка топика</span>
          </div>
          <div class="topic-textarea">
            <textarea name=""></textarea>
          </div>
          <div class="topic-footer-row">
            <div class="row">
              <div class="col-lg-8">
                <input value="Теги" class="tag-item"/>
              </div>
              <div class="col-lg-4">
                <button data-toggle="modal" data-target="myModal" type="button" class="topic-adding-gallery btn">Добавить галлерию</button>
                <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">Добавить фотогаллерю
                        <button type="button" data-dismiss="modal" area-label="close" class="close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-gallery__inner">
                        <div class="modal-gallery__top">
                          <input type="text" value="Поиск по названию" class="modal-label-item"/>
                          <input type="submit" class="modal-search-btn"/>
                          <input type="submit" class="modal-close-btn"/>
                          <select name="" class="modal-select-item">
                            <option value="">Сортировка</option>
                          </select>
                        </div>
                        <div class="modal-gallery__photo">
                          <ul>
                            <li>
                              <div class="modal-title-skin">Обложка</div>
                              <div class="modal-title-photo">Название фотогалери</div>
                              <div class="modal-title-access">Доступ</div>
                            </li>
                            <li>
                              <div class="modal-title-skin"><a href="#"><img src="img/28.png" alt=""/></a></div>
                              <div class="modal-title-photo">Название фотогалери</div>
                              <div class="modal-title-access">Открытая</div>
                            </li>
                            <li>
                              <div class="modal-title-skin"><a href="#"><img src="img/28.png" alt=""/></a></div>
                              <div class="modal-title-photo">Название фотогалери</div>
                              <div class="modal-title-access">Открытая</div>
                            </li>
                            <li>
                              <div class="modal-title-skin"><a href="#"><img src="img/28.png" alt=""/></a></div>
                              <div class="modal-title-photo">Название фотогалери</div>
                              <div class="modal-title-access">Открытая</div>
                            </li>
                            <li>
                              <div class="modal-title-skin"><a href="#"><img src="img/28.png" alt=""/></a></div>
                              <div class="modal-title-photo">Название фотогалери</div>
                              <div class="modal-title-access">Открытая</div>
                            </li>
                            <li>
                              <div class="modal-title-skin"><a href="#"><img src="img/28.png" alt=""/></a></div>
                              <div class="modal-title-photo">Название фотогалери</div>
                              <div class="modal-title-access">Открытая</div>
                            </li>
                            <li>
                              <div class="modal-title-skin"><a href="#"><img src="img/28.png" alt=""/></a></div>
                              <div class="modal-title-photo">Название фотогалери</div>
                              <div class="modal-title-access">Открытая          </div>
                              <div class="clear"></div>
                            </li>
                          </ul>
                        </div>
                        <div class="modal-gallery__btn pull-right">
                          <input type="submit" value="Отмена" class="modal-gallery__btn1"/>
                          <input type="submit" value="Добавить" class="modal-gallery__btn2"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <button data-toggle="modal" data-target="myModal" type="button" class="topic-adding-gallery btn">Добавить музыку</button>
                <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">Добавить фотогаллерю
                        <button type="button" data-dismiss="modal" area-label="close" class="close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-gallery__inner">
                        <div class="modal-gallery__top">
                          <input type="text" value="Поиск по названию" class="modal-label-item"/>
                          <input type="submit" class="modal-search-btn"/>
                          <input type="submit" class="modal-close-btn"/>
                          <select name="" class="modal-select-item">
                            <option value="">Сортировка</option>
                          </select>
                        </div>
                        <div class="modal-gallery__photo">
                          <ul>
                            <li>
                              <div class="modal-title-skin">Обложка</div>
                              <div class="modal-title-photo">Название фотогалери</div>
                              <div class="modal-title-access">Доступ</div>
                            </li>
                            <li>
                              <div class="modal-title-skin"><a href="#"><img src="img/28.png" alt=""/></a></div>
                              <div class="modal-title-photo">Название фотогалери</div>
                              <div class="modal-title-access">Открытая</div>
                            </li>
                            <li>
                              <div class="modal-title-skin"><a href="#"><img src="img/28.png" alt=""/></a></div>
                              <div class="modal-title-photo">Название фотогалери</div>
                              <div class="modal-title-access">Открытая</div>
                            </li>
                            <li>
                              <div class="modal-title-skin"><a href="#"><img src="img/28.png" alt=""/></a></div>
                              <div class="modal-title-photo">Название фотогалери</div>
                              <div class="modal-title-access">Открытая</div>
                            </li>
                            <li>
                              <div class="modal-title-skin"><a href="#"><img src="img/28.png" alt=""/></a></div>
                              <div class="modal-title-photo">Название фотогалери</div>
                              <div class="modal-title-access">Открытая</div>
                            </li>
                            <li>
                              <div class="modal-title-skin"><a href="#"><img src="img/28.png" alt=""/></a></div>
                              <div class="modal-title-photo">Название фотогалери</div>
                              <div class="modal-title-access">Открытая</div>
                            </li>
                            <li>
                              <div class="modal-title-skin"><a href="#"><img src="img/28.png" alt=""/></a></div>
                              <div class="modal-title-photo">Название фотогалери</div>
                              <div class="modal-title-access">Открытая          </div>
                              <div class="clear"></div>
                            </li>
                          </ul>
                        </div>
                        <div class="modal-gallery__btn pull-right">
                          <input type="submit" value="Отмена" class="modal-gallery__btn1"/>
                          <input type="submit" value="Добавить" class="modal-gallery__btn2"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="topic-footer-row2 pull-right">
            <div class="row">
              <input type="submit" value="Отмена" class="btn topic-cancel"/>
              <input type="submit" value="Предпосмотр" class="btn topic-preview"/>
              <input type="submit" value="Опубликовать" class="btn topic-submit"/>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
		
@stop


@section('scripts')
@include('topic.scripts')
@stop

<!--<div class="container" style="margin-top:100px">
            <div class="all-alerts">
                @foreach ($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    {{$error}}
                </div>
                @endforeach
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        {{HTML::link('topic/drafts', 'Drafts ('.Auth::user()->drafts()->count().')')}}<br>
                        <h3 class="panel-title">Create Topic</h3>
                    </div>
                    <div class="panel-body">
                        {{Form::open(array('url' => 'topic/store', 'id' => 'create-topic-form', 'class' => 'sync-form'))}}
                            <fieldset>
                                <?php
                                    $canPublishBlogs = array(0 => 'Мой персональный блог');
                                    foreach (Auth::user()->canPublishBlogs() as $blog) {
                                        $canPublishBlogs[$blog->id] = $blog->title;
                                    }  ?>
                                <div class="form-group">
                                    {{ Form::select('blog_id', $canPublishBlogs, null, array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <input class="form-control sync-input" placeholder="title" name="title" type="text" autofocus="">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control sync-input" placeholder="description" name="description" type="text" rows="15"></textarea>
                                    Relate to: <a class='btn-link rel-photo'>Photo</a> | <a class="btn-link rel-audio">Audio</a>
                                    <div class="photo-box" style="display:none;">
                                        <div class="user-photo-albums">
                                            My photo albums:
                                            @foreach(Auth::user()->photoAlbums as $photoAlbum)
                                                <div class="checkbox">
                                                    <label>
                                                        {{Form::checkbox('photo_albums[]', $photoAlbum->id, null, array('class' => 'sync-input'))}}{{$photoAlbum->name}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="user-photos">
                                            My photos:
                                            @foreach(Auth::user()->photos as $photo)
                                                <div class="checkbox">
                                                    <label>
                                                        {{Form::checkbox('photos[]', $photo->id, null, array('class' => 'sync-input'))}}<img src='{{$photo->url}}' />
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="audio-box" style="display:none;">
                                        <div class="user-audio-albums">
                                            My music albums:
                                            @foreach(Auth::user()->audioAlbums as $audioAlbum)
                                            <div class="checkbox">
                                                <label>
                                                    {{Form::checkbox('audio_albums[]', $audioAlbum->id, null, array('class' => 'sync-input'))}}{{$audioAlbum->name}}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="user-audio">
                                            My music:
                                            @foreach(Auth::user()->audios as $audio)
                                            <div class="checkbox">
                                                <label>
                                                    {{Form::checkbox('audio[]', $audio->id, null, array('class' => 'sync-input'))}}{{$audio->name}}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::text('tags', null, array('class' => 'form-control sync-input', 'id' => 'tags', 'placeholder' => 'tags')) }}
                                </div>
                                {{ Form::hidden('topic_type', 'topic') }}
                                {{ Form::hidden('topic_id') }}
                                Change this to a button or input when using this as a form 
                                {{Form::submit('Publish', array('class' => 'btn btn-default'))}}
                            </fieldset>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div> -->