@extends('misc.layout')

@section('content')
		<div class="b-content">
       @foreach ($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    {{$error}}
                </div>
                @endforeach
          <div class="b-blog-create-modal">
            <div class="b-blog-create-modal__inner">
              <div class="b-blog-create-modal__title">Создать блог
                <button class="btn-close"></button>
              </div>
              <div class="b-blog-create-modal__content">
                <div class="b-blog-create-modal-content">
                  {{Form::open(array('url' => 'blog/store', 'files' => true))}}
                    <div class="b-blog-create-modal-content__item">
                      <input name="title" type="text" value="Введите название блога" class="input-default name-blog"/>
                    </div>
                    <div class="b-blog-create-modal-content__item">
                      {{ Form::select('type_id', $type_list, null, array('class' => 'input-default select-blog')) }}
                      <span class="change-skin-title">Изображение блога</span><a href="#" class="input-default change-skin">Добавить</a>
                      <div class="b-topic-create__skin">
                        <div class="b-topic-create-skin">
                          <div class="b-topic-create-skin__title">Добавить изображение блога</div>
                        </div>
                      </div>
                    </div>
                    <div class="b-blog-create-modal-content__item">
                      <textarea name="description" cols="30" rows="10" class="textarea-blog input-default">Описание блога</textarea>
                    </div>
                    <div class="b-blog-create-modal-content__item">
                      <input type="text" value="Тэги" class="input-tag input-default"/>
                      <div class="button-group">
                        <input type="submit" value="Отмена" class="btn-cancel input-default"/>
                        <input type="submit" name='okname' value="Опубликовать" class="btn-submit input-default"/>
                      </div>
                    </div>
                  {{Form::close()}}
                </div>
              </div>
            </div>
          </div>
        </div>
@stop


<!-- <div class="container" style="margin-top:200px">
            <div class="all-alerts">
                @foreach ($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    {{$error}}
                </div>
                @endforeach
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Create Blog</h3>
                    </div>
                    <div class="panel-body">
                        {{Form::open(array('url' => 'blog/store', 'files' => true))}}
                        
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="title" name="title" type="text" autofocus="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="description" name="description" type="text" value="">
                                </div>
                                <?php
                                foreach (BlogType::where('name', '!=', 'personal')->get(array('id', 'name')) as $blogType) {
                                    $blogTypes[$blogType->id] = $blogType->name;
                                }
                                ?>
                                <div class="form-group">
                                    {{ Form::select('type_id', $blogTypes, null, array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    {{Form::file('avatar')}}
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                          <!--        {{Form::submit('Go!')}}
                          </fieldset>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div> -->