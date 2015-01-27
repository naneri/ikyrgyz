{{$blog->author->email}} created topics<br>
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
<br>
<br><br>
@include('topic.build', array('topics' => $blog->topics, 'blogInfo' => false))