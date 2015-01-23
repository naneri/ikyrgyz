@extends('misc.layout')
@section('content')

<div class="container">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Edit</h3>
			</div>
			<div class="panel-body">
				{{Form::open(array('url' => 'profile/edit', 'files'=> true))}}
					<fieldset>
						<div class="form-group">
							<input class="form-control" placeholder="email" value="{{$user->email}}" name="email" type="email" autofocus="">
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Password" name="password" type="password" value="">
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="first name" name="first_name" value="{{$user['description']->first_name}}">
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="last name" name="last_name" value="{{$user['description']->last_name}}">
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="about" name="about" value="{{$user['description']->user_profile_about}}">
						</div>
						
						{{Form::file('image')}} <br>
						{{Form::submit('Go!')}}
					</fieldset>
				{{Form::close()}}
			</div>
		</div>
	</div>
	<div class="col-md-4"></div>

</div>

@stop