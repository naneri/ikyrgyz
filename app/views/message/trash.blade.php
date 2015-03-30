@extends('misc.layout')
@extends('message.layout')
@section('form')
{{Form::open(array('url' => 'messages/action', 'name' => 'messages'))}}
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Удаленные сообщения</h4>
        {{Form::checkbox('check-all')}}
        {{Form::select('action', array('' => trans('network.choose-action'), 'restore' => trans('network.restore'), 'force_delete' => trans('network.force-delete')))}}
        <!--{{HTML::link('messages/inbox/friend', 'Друзья')}}
        {{HTML::link('messages/inbox/group', 'Группы')}}
        {{HTML::link('messages/inbox/event', 'События')}}
        {{HTML::link('messages/inbox/all', 'Все')}}-->
        {{Form::hidden('page', 'trash')}}
    </div>
    <div class="panel-body" id="messages">
        @include('message.build.messages', array('messages' => Auth::user()->messagesTrashed()))
    </div>
</div>
{{Form::close()}}
@stop