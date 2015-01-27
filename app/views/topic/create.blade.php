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
                        {{HTML::link('topic/drafts', 'Drafts ('.$user->drafts()->count().')')}}<br>
                        <h3 class="panel-title">Create Topic</h3>
                    </div>
                    <div class="panel-body">
                    	{{Form::open(array('url' => 'topic/store', 'id' => 'create-topic-form'))}}
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
                                            @foreach($user->photoAlbums as $photoAlbum)
                                                <div class="checkbox">
                                                    <label>
                                                        {{Form::checkbox('photo_albums[]', $photoAlbum->id, null, array('class' => 'sync-input'))}}{{$photoAlbum->name}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="user-photos">
                                            My photos:
                                            @foreach($user->photos as $photo)
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
                                            @foreach($user->audioAlbums as $audioAlbum)
                                            <div class="checkbox">
                                                <label>
                                                    {{Form::checkbox('audio_albums[]', $audioAlbum->id, null, array('class' => 'sync-input'))}}{{$audioAlbum->name}}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="user-audio">
                                            My music:
                                            @foreach($user->audios as $audio)
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
                                <div class="form-group">
                                    {{ Form::hidden('topic_type', 'topic') }}
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                {{Form::submit('Publish', array('class' => 'btn btn-default'))}}
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
