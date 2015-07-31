@extends("{$template}misc.layout")

@section('content')
<link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
    <div class="b-content">
          <div class="b-topic-create-modal">
            <div class="b-topic-create-modal__inner">
              <div class="b-topic-create-modal__title">{{ trans('network.edit-topic') }}
                
              </div>
              <div class="b-topic-create-modal__content">
                  <div class="b-topic-create-modal-content">
                      @foreach ($errors->all() as $error)
                          <div class="b-message b-message-error">
                              <a href="javascript: $('.b-message').remove()" class="b-message-close"></a>
                              <div class="b-message-icon b-message-error-icon"></div>
                              <p class="b-message-p">
                                  {{$error}}
                              </p>
                          </div>
                      @endforeach
                      {{Form::open(array('url' => 'topic/edit/'.$topic->id, 'files' => true, 'class' => 'sync-form', 'id' => 'edit-topic-form',))}}
                    <div class="b-topic-create-modal-content__item">
                        {{Form::text('title', $topic->title, array('class' => 'input-default add-name sync-input'))}}
                    </div>
                    <div class="b-topic-create-modal-content__item">
                        {{ Form::select('blog_id', $canPublishBlogs, $topic->blog_id, array('class' => 'choose-blog input-default sync-input')) }}
                    </div>
                     @if($topic->image_url)
                        <div id="cover-image">
                          <br><br>{{HTML::image(asset($topic->image_url))}}<br><br>
                          <button class="delete-cover">Delete</button>
                        </div>
                    @endif
                   <!-- <div class="b-topic-create-modal-content__item">
                        {{ Form::select('topic_type', $type_list, $topic->type_id, array('class' => 'choose-blog input-default sync-input')) }}
                    </div> -->
                    <div class="b-topic-create-modal-content__item">
                        <textarea name="description" cols="30" rows="10" class="input-default textarea-topic sync-input">{{$topic->description}}</textarea>
                    </div>
                    <div class="b-topic-create-modal-content__item">
                        {{ Form::text('tags', $topic->tagsToString(), array('class' => 'input-default add-name', 'id' => 'tags', 'placeholder' => 'тэги')) }}
                    </div>
                    <div class="b-topic-create-modal-content__item">
                        
                       
                          <div class="b-topic-create-modal-content__btns">
                            <input type="submit" value="Отмена" class="btn btn-cancel input-default"/>
                            <input type="submit" value="Препросмотр" class="btn btn-preview input-default"/>
                            <input type="submit" value="Опубликовать" class="btn btn-submit input-default"/>
                          </div>
                      <div class="clear"></div>
                    </div>
                      {{ Form::hidden('topic_id', $topic->id) }}
                   {{Form::close()}}
                </div>
              </div>
            </div>
          </div>
        </div>
		
@stop


@section('scripts')
@include("{$template}topic.scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
<script src="{{ URL::to('js/utils/dropzone-cover.js') }}"></script>
<script>
  
  $('.delete-cover').click(function(event){
    event.preventDefault();
    $('#cover-image').after('<div id="dZUpload" class="dropzone"><div class="dz-default dz-message">Загрузить обложку</div></div>');
    runDropzone("{{ URL::to('topic/addCover') }}");
    $('#cover-image').remove();

  })
</script>
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