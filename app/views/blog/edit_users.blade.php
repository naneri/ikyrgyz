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
			<div class="col-md-8 col-md-offset-2">
                            <div class="login-panel panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Edit Blog users</h3>
                                </div>
                                <div class="panel-body">
                                    {{Form::open(array('url' => 'blog/edit/'.$blog->id.'/users'))}}

                                        <fieldset>
                                            <table class="table">
                                                <thead>
                                                    <th>user</th>
                                                    <th>admin</th>
                                                    <th>moderator</th>
                                                    <th>reader</th>
                                                    <th>banned</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{$blog->getCreator()->email}}</td>
                                                        <td colspan="4">Blog author</td>
                                                    </tr>
                                                    @foreach($blog->getBlogUsers() as $blogUser)
                                                    <tr>
                                                        <td>{{$blogUser->email}}</td>
                                                        <td>{{Form::radio($blogUser->id, 'admin', $blog->isAdmin($blogUser->id))}}</td>
                                                        <td>{{Form::radio($blogUser->id, 'moderator', $blog->isModerator($blogUser->id))}}</td>
                                                        <td>{{Form::radio($blogUser->id, 'reader', $blog->isReader($blogUser->id))}}</td>
                                                        <td>{{Form::radio($blogUser->id, 'banned')}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <!-- Change this to a button or input when using this as a form -->
                                            {{Form::submit('Go!')}}
                                        </fieldset>
                                    {{Form::close()}}
                                </div>
                            </div>
			</div>
		</div>
@stop