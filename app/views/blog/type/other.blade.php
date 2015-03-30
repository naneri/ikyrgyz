<div class="panel panel-default" style="padding: 0 50px 40px;">
<img src="{{$blog->image}}" />
<h3>{{$blog->title}}</h3><br>
rating - 
<a href="#" class="blog_vote_up" onclick="vote.blog({{$blog->id}}, 1); return false;">UP</a>
<span class="rating" id="rating_blog_{{$blog->id}}">{{$blog->rating}}</span>
<a href="#" class="blog_vote_down" onclick="vote.blog({{$blog->id}}, - 1); return false;">DOWN</a><br>
type - {{$blog->type->name}}
@if(!$blog->isUserHaveRole())
    [{{HTML::link('/blog/'.$blog->id.'/read', 'читать')}}]
@else
    <?php $userRole = $blog->getUserRole(); ?>
    @if($userRole == 'reader')
        [{{HTML::link('/blog/'.$blog->id.'/reject', trans('network.blog-dont-read') )}}]
    @elseif($userRole == 'invite')
        [{{HTML::link('/blog/'.$blog->id.'/accept',  trans('network.accept-invitation') )}}]
    @elseif($userRole == 'request')
        [request][{{HTML::link('/blog/'.$blog->id.'/reject',  trans('reject.request') )}}]
    @elseif($userRole == 'reject')
        [{{HTML::link('/blog/'.$blog->id.'/refollow',  trans('network.read') )}}]        
    @endif
@endif

@if($blog->canEdit())
    [{{HTML::link('blog/edit/'.$blog->id, trans('network.edit'))}}]
@endif
<br>
<div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#about" aria-controls="home" role="tab" data-toggle="tab">{{ trans('network.about') }}</a></li>
        <li role="presentation"><a href="#admins" aria-controls="profile" role="tab" data-toggle="tab">{{ trans('network.administrators') }}</a></li>
        <li role="presentation"><a href="#moderators" aria-controls="messages" role="tab" data-toggle="tab">{{ trans('network.moderators') }}</a></li>
        <li role="presentation"><a href="#readers" aria-controls="readers" role="tab" data-toggle="tab">{{ trans('networks.readers') }}</a></li>
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
</div>
<br><br>
@if(($blog->type->name == 'close' && $blog->getUserRole() == 'reader') || $blog->type->name == 'open')
    @include('topic.build', array('topics' => $blog->topics, 'blogInfo' => false))
@else
    This is closed blog [{{HTML::link('/blog/'.$blog->id.'/read', 'send request')}}].
@endif