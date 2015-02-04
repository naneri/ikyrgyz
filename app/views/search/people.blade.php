@extends('misc.layout')

@section('content')
<div class="container">
    <div class="b-section-wall">
        <div class="b-section-wall__left">
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

                {{Form::submit('Поиск')}}
            {{Form::close()}}
        </div>
        <div class="b-section-wall__inner" id="users-list">
            @include('search.build.users', compact($users))
        </div>
    </div>
</div>
@stop

@section('scripts')
    @include('search.scripts')
@stop