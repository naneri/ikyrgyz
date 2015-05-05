@extends('misc.layout')

@section('content')
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
			<div class="col-md-8 col-md-offset-2">
                            <div class="login-panel panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{ trans('network.edit-blog-users') }}</h3>
                                </div>
                                <div class="panel-body">
                                    {{Form::open(array('url' => 'blog/edit/'.$blog->id.'/users'))}}

                                        <fieldset>
                                            <table class="table">
                                                <thead>
                                                    <th>{{ trans('network.user') }}</th>
                                                    <th>{{ trans('network.admin') }}</th>
                                                    <th>{{ trans('network.moderator') }}</th>
                                                    <th>{{ trans('network.reader') }}</th>
                                                    <th>{{ trans('network.banned') }}</th>
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