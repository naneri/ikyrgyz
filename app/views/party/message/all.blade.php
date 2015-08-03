@extends("{$template}misc.layout")

@section('content')

	<div class="container">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<h2>{{ trans('network.new-messages') }}</h2><br>
			@foreach($messages as $message)
				{{$message->email}} | 
				<a href="{{URL::to('message/show/' . $message->id)}}">{{$message->text}}</a>
				<br>
			@endforeach
		</div>
		<div class="col-md-4"></div>
	</div>
@stop