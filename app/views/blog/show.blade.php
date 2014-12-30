@extends('misc.layout')

@section('content')
@include('misc.createnav')
<div class="container">
    <h3>{{$blog->title}}</h3>
    <p>{{$blog->description}}</p>
    type - {{$blog->type->name}}<br>
    @if(!$blog->isHaveRelationWithUser())
        [{{HTML::link('/blog/'.$blog->id.'/read', 'read')}}]
    @else
        <?php $userStatus = $blog->getUserStatus();?>
        @if($userStatus == 'read')
            [{{HTML::link('/blog/'.$blog->id.'/reject', 'reject')}}]
        @elseif($userStatus == 'invite')
            [{{HTML::link('/blog/'.$blog->id.'/accept', 'accept invite')}}]
        @elseif($userStatus == 'request')
            [request][{{HTML::link('/blog/'.$blog->id.'/reject', 'reject')}}]
        @elseif($userStatus == 'reject')
            [{{HTML::link('/blog/'.$blog->id.'/refollow', 'refollow')}}]        
        @endif
        
        @if($blog->isAdminCurrentUser())
            {{HTML::link('blog/edit/'.$blog->id, '[edit]')}}
        @endif
    @endif
    
    @include('topic.build', array('topics' => $topics))
</div>
@stop
