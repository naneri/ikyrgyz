@extends('misc.layout')

@section('content')
@include('misc.createnav')
<div class="container">
    <h3>{{$blog->title}}</h3>
    type - {{$blog->type->name}}
    @if(!$blog->isUserHaveRole())
        [{{HTML::link('/blog/'.$blog->id.'/read', 'читать')}}]
    @else
        <?php $userRole = $blog->getUserRole(); ?>
        @if($userRole == 'reader')
            [{{HTML::link('/blog/'.$blog->id.'/reject', 'не читать')}}]
        @elseif($userRole == 'invite')
            [{{HTML::link('/blog/'.$blog->id.'/accept', 'принять приглашение')}}]
        @elseif($userRole == 'request')
            [request][{{HTML::link('/blog/'.$blog->id.'/reject', 'отменить запрос')}}]
        @elseif($userRole == 'reject')
            [{{HTML::link('/blog/'.$blog->id.'/refollow', 'читать')}}]        
        @endif

    @endif
    
    @if($blog->canEdit())
        [{{HTML::link('blog/edit/'.$blog->id, 'редактировать')}}]
    @endif
    <br>
    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#about" aria-controls="home" role="tab" data-toggle="tab">About</a></li>
            <li role="presentation"><a href="#admins" aria-controls="profile" role="tab" data-toggle="tab">Administrators</a></li>
            <li role="presentation"><a href="#moderators" aria-controls="messages" role="tab" data-toggle="tab">Moderators</a></li>
            <li role="presentation"><a href="#readers" aria-controls="readers" role="tab" data-toggle="tab">Readers</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="about">
                {{$blog->description}}
            </div>
            <div role="tabpanel" class="tab-pane" id="admins">
                @foreach($blog->getAdmins() as $blogAdmin)
                    {{$blogAdmin->email}},
                @endforeach
            </div>
            <div role="tabpanel" class="tab-pane" id="moderators">
                @foreach($blog->getModerators() as $blogModerator)
                    {{$blogModerator->email}},
                @endforeach</div>
            <div role="tabpanel" class="tab-pane" id="readers">
                @foreach($blog->getReaders() as $blogReader)
                    {{$blogReader->email}},
                @endforeach
            </div>
        </div>

    </div>
    <br><br>
    @include('topic.build', array('topics' => $topics, 'blogInfo' => false))
</div>
@stop