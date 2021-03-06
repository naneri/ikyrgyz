@extends("{$template}misc.layout")
@extends("{$template}message.layout")
@section('form')
{{Form::open(array('url' => 'messages/action', 'name' => 'messages'))}}
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>{{ trans('network.drafts') }}</h4>
        {{Form::checkbox('check-all')}}
        {{Form::select('action', array('' => trans('network.choose-action'), 'delete' => trans('network.delete')))}}
        {{Form::hidden('page', 'draft')}}
    </div>
    <div class="panel-body" id="messages">
        @include("{$template}message.build.messages", array('messages' => Auth::user()->messagesDraft()->orderBy('id', 'DESC')->paginate(20)))
    </div>
</div>
{{Form::close()}}
@stop