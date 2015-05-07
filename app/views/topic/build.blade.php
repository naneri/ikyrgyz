<input type="hidden" id="ColumnN"/>
<div class="masonry topic" style="display: none">
        @if(isset($showCreatePanel) && $showCreatePanel)
            <div class="b-widget b-user-wall">
                    <div class="b-widget__inner">
                            <div class="b-widget-list">
                                    <ul>
                                            <li class="b-widget-list__list"><a href="{{URL::to('topic/create')}}">Топик</a></li>
                                            <li class="b-widget-list__list"><a href="">Видео</a></li>
                                            <li class="b-widget-list__list"><a href="">Фото</a></li>
                                            <li class="b-widget-list__list"><a href="">Музыка</a></li>
                                            <li class="b-widget-list__list"><a href="">Ссылка</a></li>
                                            <li class="b-widget-list__list"><a href="{{ URL::to('blog/create') }}">Блог</a></li>
                                            <li class="b-widget-list__list"><a href="">Событие</a></li>
                                            <li class="b-widget-list__list"><a href=""></a></li>
                                            <div class="clear"></div>
                                    </ul>
                            </div>
                    </div>
            </div>
        @endif
	@foreach($topics as $topic)

	<div class="b-user-wall item">
		
		<div class="b-user-wall__inner">
			<div class="b-user-wall-header">
				<div class="b-user-wall-header__image"><a href="{{URL::to('profile/'.$topic->user->id)}}"><img src="{{ $topic->user->avatar()}}" alt=""/></a></div>
				<div class="b-user-wall-header__text">
				<p class="b-user-wall-header__title"><a href="{{ URL::to('topic/show/'. $topic->id) }}">{{$topic->title}}  </a></p>
				<p class="b-user-wall-header__date">
                                    <span class="moment-time"></span>
                                    <span class="moment-time-hover"></span>
                                    <span class="original-time">{{$topic->created_at}}</span>
					<div class="clear"></div>
				</p>
				</div>
				<p class="b-user-wall-header__vision">
					<img src="{{ asset('img/22.png') }}" alt=""/><span>{{$topic->count_read}}</span>
					<img src="{{ asset('img/23.png') }}" alt=""/><span>{{$topic->comments->count()}}</span>
				</p>
			</div>
			<div class="clear"></div>
			<div class="b-user-wall-image">
				@if($topic->image_url)
					<a href="{{ URL::to('topic/show/'. $topic->id) }}"><img src="{{$topic->image_url}}" alt=""></a>
				@endif
				<div class="topic-preview-text">
					{{mb_substr(strip_tags($topic->description), 0 ,200, 'UTF-8') }}
				</div>
			</div>
			<div class="b-user-wall-footer">
				<div class="b-user-wall-footer-header">
				<div class="b-user-wall-footer__image b-user-wall-header__image"><img src="{{ asset(($topic->blog->avatar)?$topic->blog->avatar:'img/48.png') }}" class="blog-avatar" alt=""/></div>
				<div class="b-user-wall-footer-social-list">
					<ul>
						<li class="b-user-wall-footer-social-list__list"><a href=""></a></li>
						<li class="b-user-wall-footer-social-list__list"><a href=""></a></li>
						<li class="b-user-wall-footer-social-list__list"><a href=""></a></li>
						<li class="b-user-wall-footer-social-list__list"><a href=""></a></li>
						<li class="b-user-wall-footer-social-list__list"><a href=""></a></li>
					</ul>
				</div>
				<p class="b-user-wall-footer__title">{{HTML::link('blog/show/'.$topic->blog->id, $topic->blog->title, array('class' => 'b-user-wall-footer__title'))}}</p>

				<?php $blogTopicsCount = $topic->blog->topics->count(); ?>
				<p class="b-user-wall-footer__number">{{$blogTopicsCount}}
					@if($blogTopicsCount == 1)
						топик
					@elseif($blogTopicsCount > 1 && $blogTopicsCount < 5)
						топика
					@else
						топиков
					@endif

					<div class="clear"></div>
				</p>
				</div>
				<div class="b-user-wall-footer-raiting">
					<div class="b-user-wall-footer-raiting__left">
						<p class="b-user-wall-footer-raiting__tag">
							#Кыргызстан #Традиции #Культура
						</p>
					</div>	
					<div class="b-user-wall-footer-raiting__right">
					<div class="b-user-wall-footer-raiting__arrow-down">
						<input type="button" class="btn-raiting">
					</div>
					<div class="b-user-wall-footer-raiting__number">
						<span class="number-raiting">+99</span>
					</div>
					<div class="b-user-wall-footer-raiting__arrow-up">
						<input type="button" class="btn-raiting">
					</div>
					</div>
					<div class="clear"></div>

				</div>
				<!-- <div class="b-user-wall-footer__btn">
				<div class="b-user-wall-footer-btn">
				<div class="b-user-wall-footer-btn__about">
				<a href="{{ URL::to('topic/show/'. $topic->id) }}" class="about-btn btn">Подробнее</a>
				</div>
				<div class="b-user-wall-footer-btn__share">
					<ul class="b-user-wall-footer-list">
						<li>
							<a href="" class="share-btn btn">Поделиться</a>
							<ul class="b-user-wall-footer-dropdown">
								<li><a href="{{ Share::load(URL::to('topic/show/'. $topic->id), $topic->description)->facebook() }}" onclick="return popitup('{{ Share::load(URL::to('topic/show/'. $topic->id), $topic->description)->facebook() }}')">Facebook</a></li>
								<li><a href="{{ Share::load(URL::to('topic/show/'. $topic->id), $topic->description)->gplus() }}" onclick="return popitup('{{ Share::load(URL::to('topic/show/'. $topic->id), $topic->description)->gplus() }}')">Google+</a></li>
								<li><a href="{{ Share::load(URL::to('topic/show/'. $topic->id), $topic->description)->twitter() }}" onclick="return popitup('{{ Share::load(URL::to('topic/show/'. $topic->id), $topic->description)->twitter() }}')">Twitter</a></li>
								<li><a href="{{ 'http://connect.mail.ru/share?share_url='.URL::to("topic/show/". $topic->id).'&title='.htmlspecialchars($topic->description)}}" onclick="return popitup('{{ 'http://connect.mail.ru/share?share_url='.URL::to("topic/show/". $topic->id).'&title='.htmlspecialchars($topic->description)}}')">Мой мир</a></li>
								<li><a href="{{ Share::load(URL::to('topic/show/'. $topic->id), $topic->description)->vk() }}" onclick="return popitup('{{ Share::load(URL::to('topic/show/'. $topic->id), $topic->description)->vk() }}')">В контакте</a></li>
							</ul>
						</li>
					</ul>
					</div>


					<div class="b-user-wall-footer-btn__minus">
					<input type="submit" onclick="return vote.topic({{$topic->id}},-1);" class="btn btn-minus"/>
					</div>
					<div class="b-user-wall-footer-btn__plus">
					<input type="submit" onclick="return vote.topic({{$topic->id}},1);" class="btn btn-plus"/>
					</div>
					<div class="b-user-wall-footer-btn__raiting">
					<span class="likes" id="rating_topic_{{$topic->id}}">{{$topic->rating}}</span>
					</div>
					</div>
					<div class="clear"></div>
				</div> -->
			</div>
		</div>
	</div>
	@endforeach
</div>
<script>
	$(document).ready(function(){
		$('.masonry').css('display', 'block');
	});
</script>