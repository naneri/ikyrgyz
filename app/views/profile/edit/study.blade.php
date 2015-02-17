@extends('misc.layout')
@section('content')

<div class="container">
    <div class="col-md-4">
        {{HTML::link('profile/edit/main', 'Основная')}}
        {{HTML::link('profile/edit/study', 'Образование')}}
        {{HTML::link('profile/edit/work', 'Работа')}}
        {{HTML::link('profile/edit/contact', 'Контакты')}}
        {{HTML::link('profile/edit/family', 'Семья')}}
        {{HTML::link('profile/edit/additional', 'Дополнительно')}}
    </div>
	<div class="col-md-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Образование</h3>
                </div>
                <div class="panel-body">
                    {{Form::open(array('url' => 'profile/edit/study'))}}
                        <fieldset>
                            Средняя школа
                            <div class="form-group">
                                {{Form::select('birthday_access', $access)}}
                            </div>
                            <div class="form-group">
                                Пол:
                                {{Form::radio('gender', 'male', $user['description']->gender == 'male')}}Мужской
                                {{Form::radio('gender', 'female', $user['description']->gender == 'female')}}Женский
                                {{Form::select('gender_access', $access, $user['description']->gender_access)}}
                            </div>
                            <div class="form-group">
                                Вы проживаете:
                                {{Form::select('liveplace_city_id', City::getAllForView(), $user['description']->liveplace_city_id)}}
                                {{Form::select('liveplace_country_id', Country::getAllForView(), $user['description']->liveplace_country_id)}}
                                {{Form::select('liveplace_access', $access, $user['description']->liveplace_access)}}
                            </div>
                            <div class="form-group">
                                Ваша родина:
                                {{Form::select('birthplace_city_id', City::getAllForView(), $user['description']->birthplace_city_id)}}
                                {{Form::select('birthplace_country_id', Country::getAllForView(), $user['description']->birthplace_country_id)}}
                                {{Form::select('birthplace_access', $access, $user['description']->birthplace_access)}}
                            </div>

                            {{Form::submit('Go!')}}
                        </fieldset>
                    {{Form::close()}}
                </div>
            </div>
	</div>
	<div class="col-md-4"></div>

</div>

@stop