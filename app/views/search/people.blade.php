@extends('misc.layout')

@section('content')
{{--HTML::style('css/bootstrap.css')--}}
@include('scripts.countries-cities')
<div class="b-content">
    <div class="b-user-interface">
        <div class="b-user-interface__header">
            <p class="title-header">{{ trans('network.search') }}
                <input type="submit" class="input-default"/>
            </p>
        </div>
        <div class="b-user-interface__inner">
            {{Form::open()}}
            <div id="tab-1" class="b-user-interface-content tab-content current">
                <div class="b-user-interface-content__left">
                    <div class="b-user-interface-content-wrapper">
                        <div class="b-user-interface-content-nav">
                            <ul class="tabs">
                                <li data-tab="tab-1" class="b-user-interface-content-nav__list tab-link current"><a href="#">{{ trans('network.people') }}</a></li>
                                <li data-tab="tab-2" class="b-user-interface-content-nav__list tab-link"><a href="{{URL::to('search/content')}}">{{ trans('network.content') }}</a></li>
                                <!--li data-tab="tab-3" class="b-user-interface-content-nav__list tab-link"><a href="#">Группы</a></li>
                                <li data-tab="tab-4" class="b-user-interface-content-nav__list tab-link"><a href="#">Медиа</a></li-->
                                <div class="clear"></div>
                            </ul>
                        </div>
                        <div class="b-user-interface-content-item">
                            <p class="b-user-interface-content-item__title">{{ trans('network.place-to-search') }}</p>
                            <div class="b-user-interface-content-item__item">
                                {{Form::select('country', Country::getAllForView(), null, array('class' => 'form-control select-country select-default'))}}
                            </div>
                            <div class="b-user-interface-content-item__item">
                                {{Form::select('city', array('0' => '{{ trans("network.city") }}'), null, array('class' => 'form-control select-city select-default'))}}
                            </div>
                            <p class="b-user-interface-content-item__title">{{ trans('network.study-organization') }}</p>
                            <div class="b-user-interface-content-item__item">
                                {{Form::select('school', array_merge(array('' => '{{ trans("network.choose-school") }}'), ProfileItem::getForView('school')), null, array('class' => 'form-control select-default'))}}
                            </div>
                            <div class="b-user-interface-content-item__item">
                                {{Form::select('university', array_merge(array('' => '{{ trans("network.choose-university") }}'), ProfileItem::getForView('university')), null, array('class' => 'form-control select-default'))}}
                            </div>
                            <p class="b-user-interface-content-item__title">{{ trans('network.working-place') }}</p>
                            <div class="b-user-interface-content-item__item">
                                {{Form::select('job', array_merge(array('' => '{{ trans("network.choose-working-place") }}'), ProfileItem::getForView('job')), null, array('class' => 'form-control select-default'))}}
                            </div>
                            <p class="b-user-interface-content-item__title">{{ trans('network.gender') }}</p>
                            <div class="b-user-interface-content-item__item">
                                <label>{{Form::radio('gender', 'male', null)}} {{ trans('network.gender-male') }}</label>
                            </div>
                            <div class="b-user-interface-content-item__item">
                                <label>{{Form::radio('gender', 'female', null)}} {{ trans('network.gender-female') }}</label>
                            </div>
                            <div class="b-user-interface-content-item__item">
                                <label>{{Form::radio('gender', 'other', null)}} {{ trans('network.any') }}</label>
                            </div>
                            <p class="b-user-interface-content-item__title">{{ trans('network.age') }}</p>
                            <div class="b-user-interface-content-item__item">
                                <label>от</label>
                                {{Form::text('age-from', null, array('class' => 'input-default'))}}
                                <label>до</label>
                                {{Form::text('age-to', null, array('class' => 'input-default'))}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="b-user-interface-content__right">
                    <div class="b-user-interface-content-search">
                        <div class="b-user-interface-content-search__search">
                            {{Form::text('search-text', null, array('class' => 'input-default'))}}
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