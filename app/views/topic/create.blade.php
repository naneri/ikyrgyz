@extends('misc.layout')

@section('content')

    <div class="b-content">
          <div class="b-topic-create-modal">
            <div class="b-topic-create-modal__inner">
              <div class="b-topic-create-modal__title">Создать топик
                <button class="btn-close"></button>
              </div>
              <div class="b-topic-create-modal__content">
                <div class="b-topic-create-modal-content">
                  {{Form::open(array('url' => 'topic/store', 'files' => true))}}
                    <div class="b-topic-create-modal-content__item">
                      <input name="title" type="text" value="Введите название" class="input-default add-name"/><a href="" class="draft">Черновики <span>999</span></a>
                    </div>
                    <div class="b-topic-create-modal-content__item">
                      {{ Form::select('blog_id', $canPublishBlogs, null, array('class' => 'choose-blog input-default')) }}
                    </div>
                    <div class="b-topic-create-modal-content__item">
                      {{ Form::select('topic_type', $type_list, null, array('class' => 'choose-blog input-default')) }}
                    </div>
                    <div class="b-topic-create-modal-content__item">
                      <textarea name="description" cols="30" rows="10" class="input-default textarea-topic"></textarea>
                    </div>
                    <div class="b-topic-create-modal-content__item">
                        <input type="file" name="photo" multiple>
                          <div class="b-topic-create-modal-content__btns">
                            <input type="submit" value="Отмена" class="btn btn-cancel input-default"/>
                            <input type="submit" value="Препросмотр" class="btn btn-preview input-default"/>
                            <input type="submit" value="Опубликовать" class="btn btn-submit input-default"/>
                          </div>
                      <div class="clear"></div>
                    </div>
                   {{Form::close()}}
                </div>
              </div>
            </div>
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