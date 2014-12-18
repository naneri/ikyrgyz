
@extends('misc.layout')


@section('content')
@include('misc.createnav')
	<div class="container">
		@foreach($topics as $topic)

		<b>{{$topic->title}}</b> <br>
                {{$topic->description}}<br>
                @if ($topic->type->name == 'image')
                    @foreach($topic->images as $image)
                        <img src='{{$image->url}}' alt='{{$image->title}}'/>
                    @endforeach
                @elseif ($topic->type->name == 'video')
                    {{$topic->video->embed_code}}
                @endif
                <br>

		@endforeach
	</div>

@stop
