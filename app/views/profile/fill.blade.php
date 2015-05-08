<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<title>I-kyrgyz		</title>
		   <link rel="shortcut icon" href="{{ URL::to('img/favicon/favicon.ico') }}">
	    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
	    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}"/>
	    <link rel="stylesheet" href="{{ asset('css/reset.css') }}"/>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	    <script type="text/javascript" src="{{ asset('jquery/jquery-ui.js') }}">		</script>
	    <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
	    <script src="{{ asset('js/masonry.pkgd.js') }}"></script>
	    <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
	    <script src="{{ asset('js/jquery.formstyler.js') }}"></script>
	    {{HTML::style('css/jquery.formstyler.css')}}
	    <script src="{{ asset('js/jquery.easytabs.js') }}"></script>
	</head>
	<body>
		<div class="b-wrapper">
			<div class="b-page">
				<div class="b-content">
					<div class="b-user-info">
						<div class="b-user-info-title">
							<p class="b-user-info-title__title">Информация о Вас</p>
						</div>
					<div class="b-user-info-block">
						<div class="b-user-info-block__left">
							<div class="b-user-info-block-photo">
								<div class="b-user-info-block-photo__image">
									<a href=""><img src="{{ asset('img/106.png') }}" alt=""></a>
								</div>
								
								<input type="submit" value="Загрузить фото" class="b-user-info-block-photo__button">
								
								<div class="b-user-info-block-photo__desc">
									Поля отмеченные <b>*</b> (звездочкой) обязательный  к заполению
								</div>
							</div>
						</div>
						<div class="b-user-info-block__right">
							<div class="b-user-info-block-label">
								<div class="b-user-info-block-label__item">
									<div class="b-user-info-block-label-item">
										<div class="b-user-info-block-label-item__title">Как вас зовут?</div>
										<div class="b-user-info-block-label-item__labels">
											<p class="b-user-info-block-label-item__desc">Имя *</p>
											<input type="text">
										</div>
										<div class="b-user-info-block-label-item__labels">
											<p class="b-user-info-block-label-item__desc">Фамилия</p>
											<input type="text">
										</div>
									</div>



								</div>

								<div class="b-user-infro-block-label__item">
									<div class="b-user-info-block-label-item">
										<div class="b-user-info-block-label-item__title">Дата рождения?</div>
										<div class="b-user-info-block-label-item__labels">
											<p class="b-user-info-block-label-item__desc">Число</p>
											<select name="" id="" class="select-default select-day">
												<option value=""></option>
											</select>
										</div>
										<div class="b-user-info-block-label-item__labels">
											<p class="b-user-info-block-label-item__desc">Месяц</p>
											<select name="" id="" class="select-default select-month">
												<option value=""></option>
											</select>
										</div>
										<div class="b-user-info-block-label-item__labels">
											<p class="b-user-info-block-label-item__desc">Год</p>
											<select name="" id="" class="select-default select-year">
												<option value=""></option>
											</select>
										</div>
										<div class="b-user-info-block-label-item__labels">
											<span class="your-male">Ваш пол<b class="star"> * </b>:</span>
											<select name="" id="" class="select-default select-male">
												<option value=""></option>
											</select>
										</div>
									</div>
								</div>

								<div class="b-user-info-block-label__item">
									<div class="b-user-info-block-label-item">
										<div class="b-user-info-block-label-item__title">Вы проживаете?<b>*</b></div>
										<div class="b-user-info-block-label-item__labels">
											<p class="b-user-info-block-label-item__desc">Страна</p>
											<input type="text">
										</div>
										<div class="b-user-info-block-label-item__labels">
											<p class="b-user-info-block-label-item__desc">Город</p>
											<input type="text">
										</div>
									</div>



								</div>

								<div class="b-user-info-block-label__item">
									<div class="b-user-info-block-label-item">
										<div class="b-user-info-block-label-item__title">Ваша родина?</div>
										<div class="b-user-info-block-label-item__labels">
											<p  class="b-user-info-block-label-item__desc">Страна</p>
											<input type="text">
										</div>
										<div class="b-user-info-block-label-item__labels">
											<p  class="b-user-info-block-label-item__desc">Город</p>
											<input type="text">
										</div>
									</div>



								</div>
								<div class="b-user-info-block-label__item">
									
									<input type="submit" value="Сохранить" class="button-save-user">
								</div>
								
							
							</div>
						</div>
					</div>
					<div class="clear"></div>

					</div>
				</div>
				@include('scripts.countries-cities')
			</div>
		</div>
	</body>
</html>