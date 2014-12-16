@extends('misc.layout')

@section('content')
		<div class="container" style="margin-top:200px">
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
                    	{{Form::open(array('url' => 'blog/store'))}}
                        
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="title" name="title" type="text" autofocus="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="description" name="description" type="text" value="">
                                </div>
                                <?php
                                $blogTypes = array(0 => 'Choose blog type');
                                foreach (BlogType::get(array('id', 'type')) as $blogType) {
                                    $blogTypes[$blogType->id] = $blogType->type;
                                }
                                ?>
                                <div class="form-group">
                                    {{ Form::select('blog_type_id', $blogTypes, null, array('class' => 'form-control')) }}
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                {{Form::submit('Go!')}}
                            </fieldset>
                       	{{Form::close()}}
                    </div>
                </div>
			</div>
			<div class="col-md-4"></div>
		</div>
@stop