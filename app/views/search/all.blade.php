@extends('misc.layout')

@section('content')
    {{HTML::style('css/bootstrap.css')}}
    {{HTML::style('css/bootstrap-select.css')}}
<div class="b-content">
    <div class="b-user-interface">
        <div class="b-user-interface__header">
            <p class="title-header">{{ trans('network.search') }}
            </p>
        </div>
        <div class="b-user-interface__inner">
            {{Form::open()}}
            <div id="tab-1" class="b-user-interface-content tab-content current">
                <div class="b-user-interface-content__left">
                    <div class="b-user-interface-content-wrapper">
                        <div class="b-user-interface-content-nav">
                            <ul class="tabs">
                                <li data-tab="tab-1" class="b-user-interface-content-nav__list tab-link current"><a class="tabCurrentLink" href="{{URL::to('search/')}}@if($search_text){{'?search-text='.$search_text}}@endif">{{ trans('network.all') }}</a></li>
                                <li data-tab="tab-2" class="b-user-interface-content-nav__list tab-link"><a href="{{URL::to('search/people')}}@if($search_text){{'?search-text='.$search_text}}@endif">{{ trans('network.people') }}</a></li>
                                <li data-tab="tab-3" class="b-user-interface-content-nav__list tab-link"><a href="{{URL::to('search/content')}}@if($search_text){{'?search-text='.$search_text}}@endif">{{ trans('network.content') }}</a></li>
                                <!--li data-tab="tab-4" class="b-user-interface-content-nav__list tab-link"><a href="#">Группы</a></li>
                                <li data-tab="tab-5" class="b-user-interface-content-nav__list tab-link"><a href="#">Медиа</a></li-->
                                <div class="clear"></div>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="b-user-interface-content__right">
                    <div class="b-user-interface-content-search">
                        <div class="b-user-interface-content-search__search">
                            {{Form::text('search-text', $search_text, array('class' => 'form-control', 'placeholder'=>'Поиск'))}}
                            {{Form::hidden('filter', "any", array())}}
                            {{Form::submit(null, array('onclick' => 'return false;', 'id' => 'btn-search', 'class' => 'button-default'))}}
                        </div>
                    </div>
                    <div id="search-result-people">
                    </div>
                    <div id="search-result-content">
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            {{Form::close()}}
        </div>
        @include('scripts.countries-cities')
    </div>
</div>
@stop

@section('scripts')
    @include('search.scripts-all')
@stop