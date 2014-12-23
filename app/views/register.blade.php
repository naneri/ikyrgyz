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
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Register</h3>
                    </div>
                    <div class="panel-body">
                    	{{Form::open(array('url' => 'register'))}}
                        
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control pass" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control pass-check" placeholder="Repeat Password" name="" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                {{Form::submit('Go!')}}
                            </fieldset>
                       	{{Form::close()}}
                    </div>
                </div>
			</div>
			<div class="col-md-3"></div>
		</div>
@stop