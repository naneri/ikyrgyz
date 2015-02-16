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
                    <h3 class="panel-title">Edit</h3>
                </div>
                <div class="panel-body">
                    {{Form::open(array('url' => 'profile/edit/main', 'files'=> true))}}
                        <fieldset>
                            <div class="form-group">
                                    <input class="form-control" placeholder="first name" name="first_name" value="{{$user['description']->first_name}}">
                                    <input class="form-control" placeholder="last name" name="last_name" value="{{$user['description']->last_name}}">
                            </div>
                            <div class="form-group">
                                Дата рождения:
                                <input class="form-control" placeholder="day" name="day" value="{{date("d",strtotime($user['description']->birthday))}}">
                                <input class="form-control" placeholder="month" name="month" value="{{date("m",strtotime($user['description']->birthday))}}">
                                <input class="form-control" placeholder="year" name="year" value="{{date("Y",strtotime($user['description']->birthday))}}">
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
                                {{Form::select('liveplace_city_id', $cities, $user['description']->liveplace_city_id)}}
                                {{Form::select('liveplace_country_id', $countries, $user['description']->liveplace_country_id)}}
                                {{Form::select('liveplace_access', $access, $user['description']->liveplace_access)}}
                            </div>
                            <div class="form-group">
                                Ваша родина:
                                {{Form::select('birthplace_city_id', $cities, $user['description']->birthplace_city_id)}}
                                {{Form::select('birthplace_country_id', $countries, $user['description']->birthplace_country_id)}}
                                {{Form::select('birthplace_access', $access, $user['description']->birthplace_access)}}
                            </div>

                            {{Form::file('image')}} <br>
                            @if($user->description->user_profile_avatar)
                                    <img src="{{$user->description->user_profile_avatar}}" alt=""><br>
                            @endif	
                            {{Form::submit('Go!')}}
                        </fieldset>
                    {{Form::close()}}
                </div>
            </div>
	</div>
	<div class="col-md-4"></div>

</div>

@stop