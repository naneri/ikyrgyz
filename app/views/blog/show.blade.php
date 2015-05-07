@extends('misc.layout')

@section('content')

   	<div class="b-content">
    	@include('misc.createnav')
        
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
                        {{HTML::link('blog/'.$blog->id.'/read', 'Подпишитесь')}} чтобы иметь доступ к просмотру топиков
                    @elseif($userRole == 'request')
                        Вы уже отправили запрос на подписку. {{HTML::link('blog/'.$blog->id.'/reject', 'Отменить')}}
                    @elseif($userRole == 'invite')
                        Вас пригласили в этот блог. {{HTML::link('blog/'.$blog->id.'/accept', 'Принять')}}
                    @elseif($userRole == 'banned')
                        Вы забанены
                    @endif
                </div>
            </div>
        @endif
                
    	@include('topic.build', array('topics' => $topics))

	</div>

	@include('scripts.script-topic', array('page' => '/blog/showAjax/' . $blog->id , 'no_sorting' => true, 'columnN' => true))	
        @include('scripts.favourite')
@stop