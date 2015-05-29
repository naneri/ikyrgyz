@extends('misc.layout')

@section('content')
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
                                <li data-tab="tab-1" class="b-user-interface-content-nav__list tab-link current"><a href="{{URL::to('search/people')}}">{{ trans('network.people') }}</a></li>
                                <li class="b-user-interface-content-nav__list tab-link"><a href="#">{{ trans('network.content') }}</a></li>
                                <!--li data-tab="tab-3" class="b-user-interface-content-nav__list tab-link"><a href="#">Группы</a></li>
                                <li data-tab="tab-4" class="b-user-interface-content-nav__list tab-link"><a href="#">Медиа</a></li-->
                                <div class="clear"></div>
                            </ul>
                        </div>
                        <div class="b-user-interface-content-sort">
                            <div class="b-user-interface-content-sort__title">{{ trans('network.sorting') }}</div>
                            <ul class="b-user-interface-content-sort-list">
                                <li class="b-user-interface-content-sort-list__list"><a href=""><label>{{ trans('network.according-to-rating') }}{Form::radio('sort', 'rating', false)}</a></li>
                                <li class="b-user-interface-content-sort-list__list"><a href=""><label>{{Form::radio('sort', 'relevant', false)}} {{ trans('network.according-to-relevance') }}</a></li>
                                <li class="b-user-interface-content-sort-list__list"><a href=""><label>{{Form::radio('sort', 'date', true)}} {{ trans('network.according-to-date') }}</a></li>
                            </ul>
                        </div>
                        <div class="b-user-interface-content-filter">
                            <p class="b-user-interface-content-filter__title">{{ trans('network.filters') }}</p>
                            <ul class="b-user-interface-content-filter-list">
                                <li class="b-user-interface-content-filter-list__list"><a href=""><label>{{Form::radio('filter', 'topic', false)}} {{ trans('network.topics') }}</label></a></li>
                                <li class="b-user-interface-content-filter-list__list"><a href=""><label>{{Form::radio('filter', 'blog', false)}} {{ trans('network.blogs') }}</label></a></li>
                                <li class="b-user-interface-content-filter-list__list"><a href=""><label>{{Form::radio('filter', 'any', true)}} {{ trans('network.any-plural') }}</label></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="b-user-interface-content__right">
                    <div class="b-user-interface-content-search">
                        <div class="b-user-interface-content-search__search">
                            {{Form::text('search-text', $search_text, array('class' => 'input-default'))}}
                            {{Form::submit(null, array('onclick' => 'return false;', 'id' => 'btn-search', 'class' => 'button-default'))}}
                        </div>
                    </div>
                    <div id="search-result">
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
@stop

@section('scripts')
    @include('search.scripts')
@stop