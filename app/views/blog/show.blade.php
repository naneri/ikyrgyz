@extends('misc.layout')

@section('content')
<div class="b-content">

{{HTML::script('js/bootstrap.js')}}

<div id="blog_{{$blog->id}}">
    @if($blog->type->name == 'personal')
        @include('blog.type.personal', compact($blog))
    @else
        @include('blog.type.other', compact($blog))
    @endif
</div>
</div>
@stop
