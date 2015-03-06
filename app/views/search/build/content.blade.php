@if($content)
@foreach($content as $entry)
<div style="padding: 10px;border:1px solid #bbb;margin-bottom: 10px;">
        @if($entry->is_topic)
            <?php $entry = Topic::find($entry->id); ?>
            <img src="{{asset($entry->image_url)}}" style="float:left;width:80px;height:80px;margin-right: 10px;" />
            <div>{{HTML::link('topic/show/'.$entry->id, $entry->title)}}</div>
            <div>{{$entry->created_at}}</div>
            <div>{{$entry->author->getNames()}}</div>
            <div>Топик</div>
        @elseif($entry->is_topic == 0)
            <?php $entry = Blog::find($entry->id); ?>
            <img src="{{asset($entry->avatar)}}" style="float:left;width:80px;height:80px;margin-right: 10px;" />
            <div>{{HTML::link('blog/show/'.$entry->id, $entry->title)}}</div>
            <div>{{$entry->created_at}}</div>
            <div>{{$entry->author->getNames()}}</div>
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
                @endif
            </div>
        @endif
    </div>
    @endforeach
@else
    По данным критериям ничего не найдено
@endif