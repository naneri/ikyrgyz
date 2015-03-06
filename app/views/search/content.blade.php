@extends('misc.layout')

@section('content')
{{HTML::style('css/bootstrap.css')}}
<div class="container">
    {{Form::open()}}
    <div class="col-lg-4">
        <div class="panel panel-default" style="padding:30px;">
            {{HTML::link('search/people', 'Люди')}}
            {{HTML::link('#', 'Контент')}}
            <!--{{HTML::link('#', 'Группы')}}
            {{HTML::link('#', 'Медиа')}}-->
            <br>
            Сортировка:
            <div class="checkbox">
                <label>
                    {{Form::radio('sort', 'rating', null)}}По рейтингу
                </label>
                <br>
                <label>
                    {{Form::radio('sort', 'relevant', null)}}По релевантности
                </label>
                <br>
                <label>
                    {{Form::radio('sort', 'date', true)}}По дате
                </label>
            </div>
            <hr>
            Фильтр:
            <div class="checkbox">
                <label>
                    {{Form::radio('filter', 'blog', null)}}Блоги
                </label>
                <br>
                <label>
                    {{Form::radio('filter', 'topic', null)}}Топики
                </label>
                <br>
                <label>
                    {{Form::radio('filter', 'any', true)}}Любые
                </label>
            </div>
        </div>
        </div>
    <div class="col-lg-8 col-md-8 panel panel-default">
        <div class="" style="padding:30px;">
            <div class="col-md-12 search-text" style="margin-bottom: 10px;">
                {{Form::text('search-text', null, array('size' => '60'))}}
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