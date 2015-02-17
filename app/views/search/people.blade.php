@extends('misc.layout')

@section('content')
<div class="container">
    {{Form::open()}}
        <div class="col-lg-5">
            {{HTML::link('#', 'Люди')}}
            {{HTML::link('search/content', 'Контент')}}
            {{HTML::link('#', 'Группы')}}
            {{HTML::link('#', 'Медиа')}}
            <br>
                Место поиска:<br>
                Выборка места проживания по заполненному
                профилю пользователя<br>
                Например: Бишкек, Кырзыгстан<br>
                Страна: {{Form::select('country', Country::getAllForView())}}<br>
                Город: {{Form::select('city', City::getAllForView())}}<br>
                <hr>
                Учебные заведения:<br>
                <hr>
                Пол:<br>
                {{Form::radio('gender', 'male', null)}}Мужской<br>
                {{Form::radio('gender', 'female', null)}}Женский<br>
                {{Form::radio('gender', 'other', true)}}Любой<br>
                <hr>
                Возраст<br>
                От {{Form::text('age-from')}} До {{Form::text('age-to')}}<br>
        </div>
        <div class="col-lg-7" id="users-list">
            <div class="col-lg-7 search-text">
                {{Form::text('search-text')}}
                {{Form::submit('Поиск', array('onclick' => 'return false;', 'id' => 'btn-search'))}}
            </div>
            <div class="col-lg-7" id="search-result">
            </div>
        </div>
    {{Form::close()}}
</div>
@stop

@section('scripts')
    @include('search.scripts')
@stop