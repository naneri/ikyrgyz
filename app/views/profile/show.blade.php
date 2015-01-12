@extends('misc.layout')

@section('content')


	<div class="container">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			{{{$user->email}}} <br>
				@if(Auth::id() != $user->id)
					@if($friend_status != True)
						<a href="{{URL::to('people/friendRequest/'. $user->id)}}">Стать друзьями</a>
					@endif
				
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Send message</h3>
					</div>
					<div class="panel-body">
					{{Form::open(array('url' => 'message/send/'.$user->id))}}
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="text" name="text">
							</div>
						</fieldset>
					{{Form::submit('Go!')}}
					{{Form::close()}}
					</div>
				</div>
				@else
					<b>Это вы</b>	
				@endif
		</div>
		<div class="col-md-4"></div>
	</div>
@stop