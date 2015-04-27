@extends('misc.layout')

@section('content')

    <div class="b-content">
          <div class="b-topic-create-modal">
            <div class="b-topic-create-modal__inner">
              <div class="b-topic-create-modal__title">{{ trans('network.create-topic') }}
                <button class="btn-close"></button>
              </div>
              <div class="b-topic-create-modal__content">
                  <div class="b-topic-create-modal-content">
                      <div class="all-alerts">
                          @foreach ($errors->all() as $error)
                          <div class="alert alert-warning alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                              {{$error}}
                          </div>
                          @endforeach
                      </div>
                    {{Form::open(array('url' => 'topic/store', 'files' => true, 'class' => 'sync-form'))}}
                    @if($type == 'link')
                    <div class="b-topic-create-modal-content__item">
                        {{Form::text('link', '', array('class' => 'input-default add-name', 'placeholder' => trans("network.link-placeholder")))}}
                        {{Form::hidden('image_url')}}
                        {{Form::hidden('link_url')}}
                        <img class="topic-cover" />
                    </div>
                    <script>
                        var prevUrl = '';
                        var inProgress = false;
                        $('input[name=link]').on("paste keyup", function() {
                            var url = this.value;
                            if(url != '' && prevUrl != url && isValidURL(url) && !inProgress){
                                inProgress = true;
                                $.get('{{URL::to("topic/create/fetch_content")}}'+'?url='+url, function($urlData){
                                   $('input[name=link_url]').val(url);
                                   $('input[name=title]').val($urlData.title);
                                   tinyMCE.activeEditor.setContent($urlData.content);
                                   if($urlData.lead_image_url){
                                       $('.topic-cover').attr('src', $urlData.lead_image_url);
                                       $('input[name=image_url]').val($urlData.lead_image_url);
                                   }
                                }).always(function(){
                                    prevUrl = url;
                                    inProgress = false;
                                });
                            }
                        });

                        function isValidURL(url){
                            var RegExp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;

                            if(RegExp.test(url)){
                                return true;
                            }else{
                                return false;
                            }
                        } 
                    </script>
                    @endif
                    <div class="b-topic-create-modal-content__item">
                        {{Form::text('title', '', array('class' => 'input-default add-name sync-input', 'placeholder' =>  trans("network.choose-name")))}}
                        <a href="{{asset('topic/drafts')}}" class="draft">{{ trans('network.drafts') }} <span>{{Auth::user()->drafts()->count()}}</span></a>
                    </div>
                    <div class="b-topic-create-modal-content__item">
                        {{ Form::select('blog_id', $canPublishBlogs, null, array('class' => 'choose-blog input-default sync-input')) }}
                    </div>
                    <!--<div class="b-topic-create-modal-content__item">
                        {{ Form::select('topic_type', $type_list, null, array('class' => 'choose-blog input-default sync-input')) }}
                    </div> -->
                    <div class="b-topic-create-modal-content__item">
                        <textarea name="description" cols="30" rows="10" class="input-default textarea-topic sync-input"></textarea>
                    </div>
                    <div class="b-topic-create-modal-content__item">
                        {{ Form::text('tags', null, array('class' => 'input-default add-name', 'id' => 'tags', 'placeholder' => trans("network.tags") )) }}
                    </div>
                    <div class="b-topic-create-modal-content__item image">
                        <input type="file" name="avatar"  accept="image/x-png, image/gif, image/jpeg">
                          <div class="b-topic-create-modal-content__btns">
                            <input type="hidden" name="image_url" />
                            <input type="submit" value="{{ trans('network.cancel') }}" class="btn btn-cancel input-default"/>
                            <input type="button" value="{{ trans('network.preview') }}" class="btn btn-preview input-default" onclick="tinyMCE.execCommand('mcePreview');"/>
                            <input type="submit" value="{{ trans('network.publish') }}" class="btn btn-submit input-default"/>
                          </div>
                      <div class="clear"></div>
                    </div>
                    {{ Form::hidden('topic_id') }}
                    {{ Form::hidden('topic_type', $type) }}
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