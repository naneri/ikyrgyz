<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>I-kyrgyz		</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/fonts.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/reset.css') }}"/>
        {{HTML::style('css/bootstrap.css')}}
        {{HTML::style('css/bootstrap-select.css')}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript" src="{{ asset('jquery/jquery-ui.js') }}"></script>
        <script src="{{ asset('js/masonry.pkgd.js') }}"></script>
    </head>
    <body style='background-color: #4CA7D3;'>
        <div class="b-wrapper">
            <div class="b-page">
                <div class="b-content">
                    <div class="col-md-8 col-md-offset-2" style="margin-top: 150px;">
                {{HTML::style('css/bootstrap.css')}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('network.main-info') }}</h3>
                    </div>
                    <div class="panel-body edit-profile">
                        {{Form::open(array('files'=> true))}}
                            <fieldset>
                                @foreach ($errors->all() as $error)
                                    <div class="b-message b-message-error">
                                        <a href="javascript: $('.b-message').remove()" class="b-message-close"></a>
                                        <div class="b-message-icon b-message-error-icon"></div>
                                        <p class="b-message-p">
                                            {{$error}}
                                        </p>
                                    </div>
                                @endforeach
                                <div class="form-group">
                                    Имя <span style="color:red;font-size: 18px;">*</span> :
                                    {{Form::text('first_name', $user['description']->first_name, array('class' => 'form-control', 'placeholder' => 'Имя'))}}
                                    Фамилия:
                                    {{Form::text('last_name', $user['description']->last_name, array('class' => 'form-control', 'placeholder' => 'Фамилия'))}}
                                </div>
                                <div class="form-group">
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
                                    {{ trans('network.birth-date') }}:
                                    {{Form::select('day', $days, $birthday[2], array('class' => 'selectpicker form-control'))}}
                                    {{Form::select('month', $month, $birthday[1], array('class' => 'selectpicker form-control'))}}
                                    {{Form::select('year', $years, $birthday[0], ['class' => 'selectpicker form-control'])}}
                                    {{Form::hidden('birthday_access', $user['description']->birthday_access)}}
                                </div>
                                <div class="form-group">
                                    Пол <span style="color:red;font-size: 18px;">*</span>:
                                    {{Form::radio('gender', 'male', $user['description']->gender == 'male')}}
                                    {{ trans('network.gender-male') }}
                                    {{Form::radio('gender', 'female', $user['description']->gender == 'female')}}
                                    {{ trans('network.gender-female') }}
                                    {{Form::hidden('gender_access', $user['description']->gender_access)}}
                                </div>
                                <div class="form-group">
                                    {{ trans('network.you-live-in') }} <span style="color:red;font-size: 18px;">*</span> :
                                    {{Form::select('liveplace_country_id', Country::getAllForView(), $user['description']->liveplace_country_id, array('class' => 'selectpicker select-country form-control'))}}
                                    {{Form::select('liveplace_city_id', City::getAllForView(), $user['description']->liveplace_city_id, array('class' => 'select-city form-control'))}}
                                    {{Form::hidden('liveplace_access', $user['description']->liveplace_access)}}
                                </div>
                                <div class="form-group">
                                    {{ trans('network.your-motherland') }}:
                                    {{Form::select('birthplace_country_id', Country::getAllForView(), $user['description']->birthplace_country_id, array('class' => 'selectpicker select-country form-control'))}}
                                    {{Form::select('birthplace_city_id', City::getAllForView(), $user['description']->birthplace_city_id, array('class' => 'select-city form-control'))}}
                                    {{Form::hidden('birthplace_access', $user['description']->birthplace_access)}}
                                </div>
                                
                                {{Form::submit(trans('network.save'))}}
                            </fieldset>
                        {{Form::close()}}

                        @include('profile.edit.set-avatar')
                    </div>
                </div>
                </div>
                </div>
                @include('scripts.countries-cities')
            </div>
        </div>
    </body>
</html>