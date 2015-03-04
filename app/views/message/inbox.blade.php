@extends('misc.layout')
@extends('message.layout')
@section('form')
<div class="panel panel-default">
    {{Form::open(array('url' => 'messages/action', 'name' => 'messages'))}}
    <div class="panel-heading">
        {{Form::checkbox('check-all')}}
        {{Form::select('action', array('' => 'Выберите действие', 'set_watch' => 'Прочитанное', 'set_notwatch' => 'Непрочитанное', 'blacklist' => 'Черный список', 'delete' => 'Удалить'))}}
        <!--{{HTML::link('messages/inbox/friend', 'Друзья')}}
        {{HTML::link('messages/inbox/group', 'Группы')}}
        {{HTML::link('messages/inbox/event', 'События')}}
        {{HTML::link('messages/inbox/all', 'Все')}}-->
        {{Form::hidden('page', 'inbox')}}
    </div>
    <div class="panel-body" id="messages">
        @include('message.build.messages', array('messages' => $messages))
    </div>
    {{Form::close()}}
</div>
@stop