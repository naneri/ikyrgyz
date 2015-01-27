@extends('misc.layout')

@section('content')
@include('misc.createnav')
<div class="container" id="blog_{{$blog->id}}">
    @if($blog->type->name == 'personal')
        @include('blog.type.personal', compact($blog))
    @else
        @include('blog.type.other', compact($blog))
    @endif
</div>
@stop
