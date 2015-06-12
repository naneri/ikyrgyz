@extends('misc.layout')

@section('content')

	<div class="b-wrapper" id="topic_{{$topic->id}}">
		<div class="b-page">
			<div class="b-content">
		  <div class="b-profile-about">
			<div class="b-profile-about__inner">
			  <div class="b-profile-about__title">
				<div class="b-profile-about-title">
				  <p class="b-profile-about-title__title">{{$topic->title}}</p>
				  <div class="b-profile-about-title__right"><span class="date moment-time"></span><span class="date moment-time-hover"></span><span class="date original-time">{{$topic->created_at}}</span>
					@if($topic->canEdit())
					  <a href="{{ URL::to('/topic/edit/' . $topic->id) }}"><input type="submit" value="{{ trans('network.topic-edit') }}" class="btn-edit button-default"/></a>
					  <a href="{{ URL::to('/topic/delete/' . $topic->id) }}"><input type="submit" value="{{ trans('network.topic-delete') }}" class="btn-delete button-default"/></a>
					@endif
					<!--<img src="{{ asset('img/22.png') }}" alt="vision"/>
					<span class="count">19</span>
					<img src="{{ asset('img/23.png') }}" alt="vision"/>
					<span class="count">34</span> -->
				  </div>
				  <div class="clear"></div>
				</div>
			  </div>
			  <div class="b-profile-about__profile">
				<div class="b-profile-about-profile"><span class="author">{{ trans('network.author') }}</span><a href="#">
						<img style="width:40px" src="{{$creator->avatar()}}" alt="" class="b-profile-about-profile__image"/>
				</a>
				  <p class="b-profile-about-profile__name">{{@$creator->description->first_name . ' '. @$creator->description->last_name}}</p>
				  <div class="b-profile-about-profile__buttons">  
					@if($creator->id !== $user_data->id)                                  
					  <a href="{{ URL::to('profile/'. $creator->id)}}">
						<input type="submit" value="{{ trans('network.profile') }}" class="input-default btn-profile"/>
					  </a>
					  <a href="{{ URL::to('people/friendRequest/'. $creator->id)}}">
						  <input type="submit" value="{{ trans('network.become-friend') }}" class="input-default btn-friend"/>
					  </a>
					@endif
					<span class="rating-text">{{ trans('network.rating') }}: <span class="rating-num">{{$creator->rating}}</span></span>
				  </div>
				  <div class="clear"></div>
				</div>
			  </div>
			  <div class="b-profile-about__text">
				<div class="b-profile-about-text topic-description">
					@if($topic->image_url != '')
						<img src="{{$topic->image_url}}" alt="" class="b-profile-about-text__image"/>
					@endif
				  <p class="b-profile-about-text__text">
					{{$topic->description}}
				  </p>
				  @if($topic->type->name == 'link')
					<p>{{HTML::link($topic->meta, null, array('target' => '_blank'))}}</p>
				  @endif
				  <div class="clear"></div>
				</div>
			  </div>
			  
			  <div class="b-profile-about__tags">
				<div class="b-profile-about-tags">
					<p class="b-profile-about-tags__title">{{ trans('network.tags') }}: {{$topic->tagsToString()}}</p>
				  <div class="b-profile-about-tags__user">
					<div class="b-profile-about-tags-user">
					  <div class="b-profile-about-tags-user__left"><span class="b-profile-about-tags-user__name">Блог</span><img src="{{ $blog->avatar() }}" alt="" class="b-profile-about-tags-user__image blog-avatar"/>
						<p class="b-profile-about-tags-user__title">{{$blog->title}}</p>
						<div class="b-profile-about-tags-user__buttons">
							<a href="{{URL::to('blog/show/'.$blog->id)}}"><button class="btn-default btn-view">{{ trans('network.watch') }}</button></a>
							<a href="{{URL::to('blog/'.$blog->id.'/read')}}"><button class="btn-default btn-follow">Подписаться</button></a>
							<span class="count-topic">{{$blog->topics->count()}} топиков</span><span class="count-followers">{{$blog->getBlogUsers()->count()}} подписчиков</span>
						</div>
					  </div>
					  <div class="b-profile-about-tags-user__right">
					<!-- 	<ul class="b-profile-about-tags-user-list dropdown">
						  <li><a href="" class="share-btn btn"></a>
							<ul class="b-profile-about-tags-user-list-dropdown sub-dropdown">
							  <li><a href="">Facebook</a></li>
							  <li><a href="">Google+</a></li>
							  <li><a href="">Twitter</a></li>
							  <li><a href="">Мой мир</a></li>
							  <li><a href="">В контакте</a></li>
							</ul>
						  </li>
						</ul> -->
						<!--   <input type="submit" class="btn btn-favourite @if($topic->isFavourite()) favourite @endif" onclick="return favourite.topic({{$topic->id}});" id="favourite_topic_{{$topic->id}}"/>
						  <input type="submit" class="btn btn-minus" onclick="return vote.topic({{$topic->id}},-1);"/>
						  <input type="submit" class="btn btn-plus" onclick="return vote.topic({{$topic->id}},1);" /><span class="likes" id="rating_topic_{{$topic->id}}">{{$topic->rating}}</span> -->
						  <div class="b-profile-about-tags-user-social">
						  	<ul>
						  		<li class="b-profile-about-tags-user-social__list"><a href="https://www.facebook.com/sharer/sharer.php?u={{ URL::to('topic/show/'. $topic->id) }}"></a></li>
						  		<li class="b-profile-about-tags-user-social__list"><a href="https://plus.google.com/share?url={{ URL::to('topic/show/'. $topic->id) }}"></a></li>
						  		<li class="b-profile-about-tags-user-social__list"><a href="ttps://twitter.com/home?status={{ URL::to('topic/show/'. $topic->id) }}"></a></li>
						  		<li class="b-profile-about-tags-user-social__list"><a href="http://connect.mail.ru/share?url={{ URL::to('topic/show/'. $topic->id) }}"></a></li>
						  		<li class="b-profile-about-tags-user-social__list"><a href="http://vkontakte.ru/share.php?url={{ URL::to('topic/show/'. $topic->id) }}"></a></li>
						  		<div class="clear"></div>
						  	</ul>
						  </div>
						<div class="b-user-wall-footer-raiting">
							<div class="b-user-wall-footer-raiting__arrow-down">
						<input type="button" onclick="return vote.topic({{$topic->id}},-1);" class="btn-raiting">
					</div>
					<div class="b-user-wall-footer-raiting__number">
						<span class="number-raiting" id="rating_topic_{{$topic->id}}">{{$topic->rating}}</span>
					</div>
					<div class="b-user-wall-footer-raiting__arrow-up">
						<input type="button" onclick="return vote.topic({{$topic->id}},1);" class="btn-raiting">
					</div>
					</div>
						</div>
					  </div>
					  <div class="clear"></div>
					</div>
				  </div>
				</div>
				 
				  <div class="b-profile-about-profile__name" style="height: 20px;">
					  <div style="float:left;">Комментарии {{$topic->comments->count()}}</div>
					  <div style="float:right;">Сортировка: {{Form::select('sort_by', array('old' => 'Старые', 'new' => 'Новые', 'rating' => 'По рейтингу'))}}</div>
				  </div>
				  <hr>
				  <div style="padding: 20px 0; font-size: 18px;">
					<a href="javascript:;" onclick="comment.postCommentForm()">Оставить комментарий</a>
				  </div>
				  <div class="post-comment" style="display: none;">
						<div style="height:50px;">
							  {{HTML::image(Auth::user()->avatar(), '', array('style' => 'float:left;width:40px;height:40px;margin-right:10px;'))}}
							  <span style="line-height: 40px;" class="b-profile-about-profile__name"> {{Auth::user()->getNames()}}</span>
						</div>
						<div id="add_comment_0">
							{{Form::textarea('comment', null, array('class' => 'add_comment_text'))}}
							<div class="b-profile-about-message-button">
								<input type="button" value="Опубликовать" class="button-default button-submit" onclick="comment.submit(0,{{$topic->id}});">
							</div>
						</div>
					</div>
				  <div id="comments_child_0">
					@include('comments.build', array('comments' => $comments, 'isModerator' => $isModerator, 'parent' => null, 'sort' => $commentsSort))
				  </div>
				@include('comments.scripts')
			  </div>
			  </div>
			 
			</div>
		  </div>
		</div>
		</div>
	</div>
<script>
$(document).ready(function(){
	comment.convertTimes('body');
	comment.initEditor("textarea.add_comment_text");
	$('select[name="sort_by"]').change(function(){
		comment.sort({{$topic->id}}, $(this).val());
	});
});
</script>
@stop

@section('scripts')
<script>
$(document).ready(function(){
	times.init('.b-profile-about-title__right');
	times.convert('.b-profile-about-title__right');
});
</script>
@include('scripts.favourite')
@stop