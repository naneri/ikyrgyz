@extends('misc.layout')

@section('content')
<div class="container">
    <div class="col-lg-5">
            {{Form::open()}}
                Место поиска:<br>
                Выборка места проживания по заполненному
                профилю пользователя<br>
                Например: Бишкек, Кырзыгстан<br>
                Страна: {{Form::select('country')}}<br>
                Город: {{Form::select('city')}}<br>
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
            {{Form::close()}}
    </div>
    <div class="col-lg-7" id="users-list">
        @include('search.build.users', compact($users))
    </div>
</div>
@stop

@section('scripts')
    @include('search.scripts')
@stop