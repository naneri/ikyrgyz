@extends('misc.layout')

@section('content')
{{HTML::style('css/bootstrap.mod.css')}}
<div class="b-content">
		<div class="container" style="margin-top:200px">
			@foreach ($errors->all() as $error)
                <div class="b-message b-message-error">
                    <a href="javascript: $('.b-message').remove()" class="b-message-close"></a>
                    <div class="b-message-icon b-message-error-icon"></div>
                    <p class="b-message-p">
                        {{$error}}
                    </p>
                </div>
            @endforeach
			<div class="col-md-4"></div>
			<div class="col-md-4">
                            <div class="login-panel panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{ trans('network.edit-blog') }}</h3><br>
                                </div>
                                <div class="panel-body">
                                    {{Form::open(array('url' => 'blog/edit/'.$blog->id))}}

                                        <fieldset>
                                            <div class="form-group">
                                                <input class="form-control" name="title" type="text" autofocus="" value="{{$blog->title}}">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control"name="description" type="text" value="{{$blog->description}}">
                                            </div>
                                            <?php
                                            foreach (BlogType::where('name', '!=', 'personal')->get(array('id', 'name')) as $blogType) {
                                                $blogTypes[$blogType->id] = $blogType->name;
                                            }
                                            ?>
                                            <div class="form-group">
                                                {{ Form::select('type_id', $blogTypes, $blog->type_id, array('class' => 'form-control')) }}
                                            </div>
                                            <!-- Change this to a button or input when using this as a form -->
                                            {{Form::submit(trans('network.save'))}}
                                        </fieldset>
                                    {{Form::close()}}
                                </div>
                            </div>
			</div>
			<div class="col-md-4"></div>
		</div>
</div>
@stop