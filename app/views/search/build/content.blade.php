@if($content)
    @foreach($content as $entry)
        @if($entry->is_topic)
            <div class="b-user-interface-content-block">
                <div class="b-user-interface-content-block__image"><img src="{{asset(($entry->image_url)?$entry->image_url:'img/56.png')}}" alt=""/></div>
                <div class="b-user-interface-content-block__text">
                    <div class="b-user-interface-content-block-text">
                        <p class="b-user-interface-content-block-text__title">{{$entry->title}}</p>
                        <p class="b-user-interface-content-block-text__date">{{$entry->created_at}}, {{ trans('network.topic-of-blog') }}</p>
                        <p class="b-user-interface-content-block-text__name">{{$entry->first_name.' '.$entry->last_name}}</p>
                        <p class="b-user-interface-content-block-text__desc">{{ trans('network.topic') }}</p>
                    </div>
                </div>
                <div class="b-user-interface-content-block__detail">
                    <div class="b-user-interface-content-block-detail">
                        <p class="b-user-interface-content-block-detail__vision"><img src="{{asset('img/22.png')}}" alt=""/><span>{{$entry->count_read}}</span><img src="{{asset('img/23.png')}}" alt=""/><span>{{$entry->comments_count}}</span></p>
                        <p class="b-user-interface-content-block-detail__raiting"><span>{{round($entry->rating,2)}}</span></p>
                        <div class="b-user-interface-content-block-detail__buttons">
                            <a href="{{URL::to('topic/show/'.$entry->id)}}"><input type="button" value="Подробнее" class="button-default"/></a>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        @elseif($entry->is_topic == 0)
            <div class="b-user-interface-content-block">
                <div class="b-user-interface-content-block__image"><img src="{{asset(($entry->avatar)?$entry->avatar:'img/56.png')}}" alt=""/></div>
                <div class="b-user-interface-content-block__text">
                    <div class="b-user-interface-content-block-text">
                        <p class="b-user-interface-content-block-text__title">{{$entry->title}}</p>
                        <p class="b-user-interface-content-block-text__date">{{$entry->created_at}}</p>
                        <p class="b-user-interface-content-block-text__name">{{$entry->first_name.' '.$entry->last_name}}</p>
                        <p class="b-user-interface-content-block-text__desc">Блог</p>
                    </div>
                </div>
                <div class="b-user-interface-content-block__detail">
                    <div class="b-user-interface-content-block-detail">
                        <p class="b-user-interface-content-block-detail__raiting"><span>{{round($entry->rating, 2)}}</span></p>
                        <div class="b-user-interface-content-block-detail__buttons">
                            <a href="{{URL::to('blog/show/'.$entry->id)}}"><input type="button" value="Подробнее" class="button-default"/></a>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        @endif
    @endforeach
@else
    По данным критериям ничего не найдено
@endif