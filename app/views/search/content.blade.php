@extends('misc.layout')

@section('content')
<div class="container">
    {{Form::open()}}
        <div class="col-lg-5">
            {{HTML::link('search/people', 'Люди')}}
            {{HTML::link('#', 'Контент')}}
            {{HTML::link('#', 'Группы')}}
            {{HTML::link('#', 'Медиа')}}
            <br>
                    Сортировка:<br>
                    {{Form::radio('sort', 'rating', null)}}По рейтингу<br>
                    {{Form::radio('sort', 'relevant', null)}}По релевантности<br>
                    {{Form::radio('sort', 'date', true)}}По дате<br>
                    <hr>
                    Фильтр:<br>
                    {{Form::radio('filter', 'blog', null)}}Блоги<br>
                    {{Form::radio('filter', 'topic', null)}}Топики<br>
                    {{Form::radio('filter', 'any', true)}}Любые<br>
        </div>
        <div class="col-lg-7">
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