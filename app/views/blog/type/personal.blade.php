{{$blog->author->email}} created topics<br>
@if(!$blog->isUserHaveRole())
    [{{HTML::link('/blog/'.$blog->id.'/read', trans('network.read'))}}]
@else
    <?php $userRole = $blog->getUserRole(); ?>
    @if($userRole == 'reader')
        [{{HTML::link('/blog/'.$blog->id.'/reject', trans('network.dont-read'))}}]
    @elseif($userRole == 'invite')
        [{{HTML::link('/blog/'.$blog->id.'/accept', trans('network.accept-invitation'))}}]
    @elseif($userRole == 'request')
        [request][{{HTML::link('/blog/'.$blog->id.'/reject', trans('network.reject-request'))}}]
    @elseif($userRole == 'reject')
        [{{HTML::link('/blog/'.$blog->id.'/refollow', trans('network.read'))}}]        
    @endif
@endif
<br>
<br><br>
@include('topic.build', array('topics' => $blog->topics, 'blogInfo' => false))