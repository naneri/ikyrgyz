@if($content)
    @foreach($content as $entry)
    <div style="width:100%;height:110px;">
        @if($entry->is_topic)
            <?php $entry = Topic::find($entry->id); ?>
            <img src="" style="float:left;width:100px;height:100px;" />
            <div>{{HTML::link('topic/show/'.$entry->id, $entry->title)}}</div>
            <div>{{$entry->created_at}}</div>
            <div>{{$entry->author->email}}</div>
            <div>Топик</div>
        @else
            <?php $entry = Blog::find($entry->id); ?>
            <img src="" style="float:left;width:100px;height:100px;" />
            <div>{{HTML::link('blog/show/'.$entry->id, $entry->title)}}</div>
            <div>{{$entry->created_at}}</div>
            <div>{{$entry->author->email}}</div>
            <div>Блог  
                @if(!$entry->isUserHaveRole())
                [{{HTML::link('/blog/'.$entry->id.'/read', 'читать')}}]
                @else
                    <?php $userRole = $entry->getUserRole(); ?>
                    @if($userRole == 'reader')
                    [{{HTML::link('/blog/'.$entry->id.'/reject', 'не читать')}}]
                    @elseif($userRole == 'invite')
                    [{{HTML::link('/blog/'.$entry->id.'/accept', 'принять приглашение')}}]
                    @elseif($userRole == 'request')
                    [request][{{HTML::link('/blog/'.$entry->id.'/reject', 'отменить запрос')}}]
                    @elseif($userRole == 'reject')
                    [{{HTML::link('/blog/'.$entry->id.'/refollow', 'читать')}}]        
                    @endif
                @endif</div>
        @endif
    </div>
    @endforeach
@else
    По данным критериям ничего не найдено
@endif