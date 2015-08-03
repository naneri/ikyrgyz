@extends("{$template}misc.layout")


@section('content')
            <div class="b-content">
            	@include("{$template}misc.createnav")
                @include("{$template}topic.build", array('topics' => $topics, 'blogInfo' => true))
            </div>    
@stop
