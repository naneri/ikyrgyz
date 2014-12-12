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
                               <!-- <div class="form-group">
                                    <textarea class="form-control" placeholder="description" name="description" type="text" value="" rows="3"></textarea>
                                </div> -->
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