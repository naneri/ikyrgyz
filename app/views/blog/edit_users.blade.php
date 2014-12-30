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
                        <h3 class="panel-title">Edit Blog users</h3>
                    </div>
                    <div class="panel-body">
                    	{{Form::open(array('url' => 'blog/edit/'.$blog->id.'/users'))}}
                        
                            <fieldset>
                                
                                <div class="form-group">
                                    <?php $blogUsers = $blog->getBlogUsers();?>
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