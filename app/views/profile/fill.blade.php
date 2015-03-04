<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>I-kyrgyz		</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/fonts.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/reset.css') }}"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript" src="{{ asset('jquery/jquery-ui.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
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
                        <h3 class="panel-title">Основная информация</h3>
                    </div>
                    <div class="panel-body">
                        {{Form::open(array('files'=> true))}}
                            <fieldset>
                                <div class="all-alerts">
                                    @foreach (@$errors->all() as $error)
                                    <div class="alert alert-warning alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        {{$error}}
                                    </div>
                                    @endforeach
                                </div>
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
                                    Дата рождения:
                                    {{Form::select('day', $days, $birthday[2], array('class' => 'form-control'))}}
                                    {{Form::select('month', $month, $birthday[1], array('class' => 'form-control'))}}
                                    {{Form::select('year', $years, $birthday[0], ['class' => 'form-control'])}}
                                    {{Form::hidden('birthday_access', $user['description']->birthday_access)}}
                                </div>
                                <div class="form-group">
                                    Пол <span style="color:red;font-size: 18px;">*</span>:
                                    {{Form::radio('gender', 'male', $user['description']->gender == 'male')}}Мужской
                                    {{Form::radio('gender', 'female', $user['description']->gender == 'female')}}Женский
                                    {{Form::hidden('gender_access', $user['description']->gender_access)}}
                                </div>
                                <div class="form-group">
                                    Вы проживаете <span style="color:red;font-size: 18px;">*</span> :
                                    {{Form::select('liveplace_city_id', City::getAllForView(), $user['description']->liveplace_city_id)}}
                                    {{Form::select('liveplace_country_id', Country::getAllForView(), $user['description']->liveplace_country_id)}}
                                    {{Form::hidden('liveplace_access', $user['description']->liveplace_access)}}
                                </div>
                                <div class="form-group">
                                    Ваша родина:
                                    {{Form::select('birthplace_city_id', City::getAllForView(), $user['description']->birthplace_city_id)}}
                                    {{Form::select('birthplace_country_id', Country::getAllForView(), $user['description']->birthplace_country_id)}}
                                    {{Form::hidden('birthplace_access', $user['description']->birthplace_access)}}
                                </div>

                                {{Form::file('image')}} <br>
                                @if(@$user->description->user_profile_avatar)
                                        <img src="{{$user->description->user_profile_avatar}}" alt=""><br>
                                @endif	
                                {{Form::submit('Go!')}}
                            </fieldset>
                        {{Form::close()}}
                    </div>
                </div>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>