@extends('misc.layout')

@section('content')
{{HTML::style('css/bootstrap.css')}}
@include('scripts.countries-cities')
<div class="container">
    {{Form::open()}}
        <div class="col-md-4">
            <div class="panel panel-default" style="padding:30px;">
                {{HTML::link('#', 'Люди')}} |
                {{HTML::link('search/content', 'Контент')}} 
                <!--{{HTML::link('#', 'Группы')}} |
                {{HTML::link('#', 'Медиа')}} -->
                <br><br>
                    Место поиска:<br>
                    {{Form::select('country', Country::getAllForView(), null, array('class' => 'form-control select-country'))}}<br>
                    {{Form::select('city', City::getAllForView(), null, array('class' => 'form-control select-city'))}}<br>
                    <hr>
                    Учебные заведения:
                    {{Form::select('school', array_merge(array('' => 'Выберите школу'), ProfileItem::getForView('school')), null, array('class' => 'form-control'))}}<br>
                    {{Form::select('university', array_merge(array('' => 'Выберите университет'), ProfileItem::getForView('university')), null, array('class' => 'form-control'))}}
                    <hr>
                    Места работы:
                    {{Form::select('job', array_merge(array('' => 'Выберите место работы'), ProfileItem::getForView('job')), null, array('class' => 'form-control'))}}
                    <hr>
                    Пол:<br>
                    <div class="checkbox">
                        <label>
                            {{Form::radio('gender', 'male', null)}} Мужской
                        </label>
                        <label>
                            {{Form::radio('gender', 'female', null)}} Женский
                        </label>
                        <label>
                            {{Form::radio('gender', 'other', true)}} Любой
                        </label>
                    </div>
                    <hr>
                    Возраст<br>
                    От {{Form::text('age-from', null, array('size' => 4))}} До {{Form::text('age-to', null, array('size' => 4))}}<br>
            </div>
        </div>
    <div class="col-md-8 panel panel-default" id="users-list">
        <div class="" style="padding:30px;">
            <div class="col-md-12 search-text" style="margin-bottom:20px;">
                {{Form::text('search-text', null, array('size' => '60', 'class' => 'form-group'))}}
                {{Form::submit('Поиск', array('onclick' => 'return false;', 'id' => 'btn-search'))}}
            </div>
            <div class="col-md-12" id="search-result">
            </div>
        </div>
        </div>
    {{Form::close()}}
</div>
@stop

@section('scripts')
    @include('search.scripts')
@stop