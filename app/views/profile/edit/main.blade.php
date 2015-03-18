@extends('misc.layout')
@extends('profile.edit.layout')
@section('form')
<div class="login-panel panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Основная информация</h3>
    </div>
    <div class="panel-body">
        {{Form::open(array('url' => 'profile/edit/main', 'files'=> true))}}
            <fieldset>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="first name" name="first_name" value="{{$user['description']->first_name}}">
                    <input type="text" class="form-control" placeholder="last name" name="last_name" value="{{$user['description']->last_name}}">
                </div>
                <div class="form-group">
                    Дата рождения:
                    {{Form::select('day', $days, $birthday['day'], array('class' => 'form-control'))}}
                    {{Form::select('month', $month, $birthday['month'], array('class' => 'form-control'))}}
                    {{Form::select('year', $years, $birthday['year'], ['class' => 'form-control'])}}
                    {{Form::select('birthday_access', $access, $user['description']->birthday_access)}}
                </div>
                <div class="form-group">
                    Пол:
                    {{Form::radio('gender', 'male', $user['description']->gender == 'male')}}Мужской
                    {{Form::radio('gender', 'female', $user['description']->gender == 'female')}}Женский
                    {{Form::select('gender_access', $access, $user['description']->gender_access)}}
                </div>
                <div class="form-group">
                    Вы проживаете:
                    {{Form::select('liveplace_country_id', Country::getAllForView(), $user['description']->liveplace_country_id, array('class' => 'select-country form-control'))}}
                    {{Form::select('liveplace_city_id', City::getAllForView(), $user['description']->liveplace_city_id, array('class' => 'select-city form-control'))}}
                    {{Form::select('liveplace_access', $access, $user['description']->liveplace_access)}}
                </div>
                <div class="form-group">
                    Ваша родина:
                    {{Form::select('birthplace_country_id', Country::getAllForView(), $user['description']->birthplace_country_id, array('class' => 'select-country form-control'))}}
                    {{Form::select('birthplace_city_id', City::getAllForView(), $user['description']->birthplace_city_id, array('class' => 'select-city form-control'))}}
                    {{Form::select('birthplace_access', $access, $user['description']->birthplace_access)}}
                </div>

                Изображение профиля: {{Form::file('image')}} <br>
                @if(@$user->description->user_profile_avatar)
                        <img style="width:100px" src="{{$user->description->user_profile_avatar}}" alt=""><br>
                @endif	
                {{Form::submit('Сохранить')}}
            </fieldset>
        {{Form::close()}}
    </div>
</div>
@include('scripts.countries-cities')
@stop