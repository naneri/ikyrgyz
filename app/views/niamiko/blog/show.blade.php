@extends("{$template}misc.layout")

@section('content')

   	<div class="b-content">
    	@include("{$template}misc.createnav")
        
        <div style="width: 100%; background: #fff; padding: 20px 0;margin-bottom: 14px;">
            <div style="margin: 0 20px;font-family: 'PT Sans Caption';">
                <h3 style="font-size: 15px;font-weight: bold;margin-bottom: 20px;">{{$blog->title}}</h3>
                <div style="margin-bottom: 20px;">{{$blog->description}}</div>
                @if($blog->canEdit())
                <div>
                    {{HTML::link('blog/edit/'.$blog->id, 'Редактировать')}} |
                    {{HTML::link('blog/edit/'.$blog->id.'/users', 'Управление пользователями')}}
                </div>
                @endif
                <div class="b-profile-about-tags-user__right">
                    <input type="submit" class="btn btn-favourite @if($blog->isFavourite()) favourite @endif" onclick="return favourite.blog({{$blog->id}});" id="favourite_blog_{{$blog->id}}"/>
                </div>
            </div>
        </div>
        
        @if(!$blog->canView())
            <div style="width: 100%; background: #fff; padding: 20px 0;">
                <div style="margin: 0 20px;font-family: 'PT Sans Caption';">
                    @if(!$userRole || $userRole == 'reject')
                        {{HTML::link('blog/'.$blog->id.'/read', trans('network.subscribe-imperative'))}} {{ trans('network.to-have-topic-access') }}
                    @elseif($userRole == 'request')
                        {{ trans('network.you-have-already-sent-request') }} {{HTML::link('blog/'.$blog->id.'/reject', trans('network.reject'))}}
                    @elseif($userRole == 'invite')
                        {{ trans('network.you-were-invited-to-blog') }} {{HTML::link('blog/'.$blog->id.'/accept', trans('network.accept'))}}
                    @elseif($userRole == 'banned')
                        {{ trans('network.you-are-banned') }}
                    @endif
                </div>
            </div>
        @endif
                
    	@include("{$template}topic.build", array('topics' => $topics))

	</div>

	@include('scripts.script-topic', array('page' => '/blog/showAjax/' . $blog->id , 'no_sorting' => true, 'columnN' => true))	
        @include('scripts.favourite')
@stop