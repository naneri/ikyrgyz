<?php
	$birthday = explode('-', $user['description']->birthday);
	$days = ['0' => 'День'];
	for ($day = 1; $day < 32; $day++) {
	    $days[$day] = $day;
	}
	$startYear = (int) date('Y');
	$endYear = (int) date('Y') - 100;
	$years = ['0' => 'Год'];
	for ($year = $startYear; $year > $endYear; $year--) {
	    $years[$year] = $year;
	};
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<title>{{Config::get('app.network_name')}}</title>
		   <link rel="shortcut icon" href="{{ URL::to('img/favicon/favicon.ico') }}">
	    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
	    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}"/>
	    <link rel="stylesheet" href="{{ asset('css/reset.css') }}"/>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	    <script type="text/javascript" src="{{ asset('jquery/jquery-ui.js') }}">		</script>
	  <!--  <script type="text/javascript" src="{{ asset('js/script.js') }}"></script> -->
	    <script src="{{ asset('js/masonry.pkgd.js') }}"></script>
	    <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
	    {{HTML::style('css/jquery.formstyler.css')}}
	    <script src="{{ asset('js/jquery.easytabs.js') }}"></script>
	    <style>
			.ui-helper-hidden-accessible { display:none; }
	    </style>
	</head>
	<body>
		<div class="b-wrapper">
			<div class="b-page">
				<div class="b-content">
					{{Form::open(['url' => 'profile/fill'])}}
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
											{{Form::text('first_name', $user['description']->first_name, array('class' => 'form-control', 'placeholder' => 'Имя'))}}
										</div>
										<div class="b-user-info-block-label-item__labels">
											<p class="b-user-info-block-label-item__desc">Фамилия</p>
											{{Form::text('last_name', $user['description']->last_name, array('class' => 'form-control', 'placeholder' => 'Фамилия'))}}
										</div>
									</div>
<script>
	$(document).ready(function(){

		$.get( "{{URL::to('/country-list')}}", function( data ) {
			$( ".live_country" ).autocomplete({
		      	source: data,
		      	select: function( event, ui ){
					$.get( "{{URL::to('/city-list')}}/" + ui.item.value, function( data ) {
						$( ".live_city" ).autocomplete({
					      	source: data
					    });
					});
			    }
			});

			$( ".birth_country" ).autocomplete({
		      	source: data,
		      	select: function( event, ui ){
					$.get( "{{URL::to('/city-list')}}/" + ui.item.value, function( data ) {
						$( ".birth_city" ).autocomplete({
					      	source: data
					    });
					});
			    }
			});
		});

	});
</script>
								</div>

								<div class="b-user-infro-block-label__item">
									<div class="b-user-info-block-label-item">
										<div class="b-user-info-block-label-item__title">Дата рождения?</div>
										<div class="b-user-info-block-label-item__labels">
											<p class="b-user-info-block-label-item__desc">Число</p>
											{{Form::select('day', $days, $birthday[2], array('class' => 'select-default select-day'))}}
										</div>
										<div class="b-user-info-block-label-item__labels">
											<p class="b-user-info-block-label-item__desc">Месяц</p>
											{{Form::select('month', $month, $birthday[1], array('class' => 'select-default select-month'))}}
										</div>
										<div class="b-user-info-block-label-item__labels">
											<p class="b-user-info-block-label-item__desc">Год</p>
											{{Form::select('year', $years, $birthday[0], ['class' => 'select-default select-year'])}}
										</div>
										<div class="b-user-info-block-label-item__labels">
											<span class="your-male">Ваш пол<b class="star"> * </b>:</span>
											{{Form::select('gender', $genders, null, ['class' => 'select-default select-male'])}}
										</div>
									</div>
								</div>

								<div class="b-user-info-block-label__item">
									<div class="b-user-info-block-label-item">
										<div class="b-user-info-block-label-item__title">Вы проживаете?<b>*</b></div>
										<div class="b-user-info-block-label-item__labels">
											<p class="b-user-info-block-label-item__desc">Страна</p>
											{{Form::text('live_country', null, ['class' => 'live_country'])}}
										</div>
										<div class="b-user-info-block-label-item__labels">
											<p class="b-user-info-block-label-item__desc">Город</p>
											{{Form::text('live_city', null, ['class' => 'live_city'])}}
										</div>
									</div>



								</div>

								<div class="b-user-info-block-label__item">
									<div class="b-user-info-block-label-item">
										<div class="b-user-info-block-label-item__title">Ваша родина?</div>
										<div class="b-user-info-block-label-item__labels">
											<p  class="b-user-info-block-label-item__desc">Страна</p>
											{{Form::text('birth_country', null, ['class' => 'birth_country'])}}
										</div>
										<div class="b-user-info-block-label-item__labels">
											<p  class="b-user-info-block-label-item__desc">Город</p>
											{{Form::text('birth_city', null, ['class' => 'birth_city'])}}
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
					{{Form::close()}}
				</div>
				@include('scripts.countries-cities')
			</div>
		</div>
	</body>
</html>