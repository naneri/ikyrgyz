@extends("{$template}misc.layout")

@section('content')
	
	@include('scripts.script-topic', array('page' => 'blog'))
   	<div class="b-content">
    	@include("{$template}misc.createnav")
    	@include("{$template}blog.build", array('blogs' => $blogs))

	</div>
@stop