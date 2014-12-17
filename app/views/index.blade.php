
@extends('misc.layout')


@section('content')
@include('misc.createnav')
	<div class="container">
		@foreach($topics as $topic)

		<b>{{$topic->title}}</b> <br>
                {{$topic->content}}<br>
                @if ($topic->type->name == 'image')
                    @foreach($topic->images as $image)
                        <img src='{{$image->url}}' alt='{{$image->title}}'/>
                    @endforeach
                @endif
                <br>

		@endforeach
	</div>

@stop
