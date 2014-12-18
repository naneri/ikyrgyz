@extends('misc.layout')

@section('content')

    @include('misc.createnav')
		<div class="container" style="margin-top:100px">
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
                        <h3 class="panel-title">Create Topic</h3>
                    </div>
                    <div class="panel-body">
                    	{{Form::open(array('url' => 'topic/store'))}}
                        
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="title" name="title" type="text" autofocus="">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="description" name="description" type="text" value="" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    {{ Form::text('tags', null, array('class' => 'form-control', 'id' => 'tags', 'placeholder' => 'tags')) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::hidden('topic_type', 'text') }}
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-justified" id="topic_types">
                                        <li class="active"><a href="#text" data-toggle="tab" data-topic-type="text">Text</a></li>
                                        <li><a href="#image" data-toggle="tab" data-topic-type="image">Image</a></li>
                                        <li><a href="#video" data-toggle="tab" data-topic-type="video">Video</a></li>
                                        <li><a href="#audio" data-toggle="tab" data-topic-type="audio">Audio</a></li>
                                        <li><a href="#link" data-toggle="tab" data-topic-type="link">Link</a></li>
                                        <li><a href="#polling" data-toggle="tab" data-topic-type="polling">Polling</a></li>
                                        <li><a href="#event" data-toggle="tab" data-topic-type="event">Event</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content" style="padding-top:15px;">
                                        <div class="tab-pane" id="text">...</div>
                                        <div class="tab-pane" id="image">
                                            <input type="file" class="form-control" id="file" multiple />
                                            <img src="{{Input::old('image')}}" id="thumb" style="max-width:300px; max-height: 200px; display:block; ">
                                            <div class="error"></div>
                                        </div>
                                        <div class="tab-pane" id="video">
                                            <input type="text" class="form-control" id="video_input" placeholder="embed code or url video"/>
                                            <input type='hidden' name='video_url' />
                                            <input type='hidden' name='video_embed_code' />
                                            <div class='video_preview'>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="audio">...</div>
                                        <div class="tab-pane" id="link">...</div>
                                        <div class="tab-pane" id="polling">...</div>
                                        <div class="tab-pane" id="event">...</div>
                                    </div>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                {{Form::submit('Go!')}}
                            </fieldset>
                       	{{Form::close()}}
                    </div>
                </div>
			</div>
			<div class="col-md-2"></div>
		</div>
@stop


@section('scripts')
@include('topic.scripts')
@stop