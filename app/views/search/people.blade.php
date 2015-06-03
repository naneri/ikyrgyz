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
                                <li data-tab="tab-1" class="b-user-interface-content-nav__list tab-link"><a href="{{URL::to('search/')}}@if($search_text){{'?search-text='.$search_text}}@endif">{{ trans('network.all') }}</a></li>
                                <li data-tab="tab-2" class="b-user-interface-content-nav__list tab-link current"><a href="#">{{ trans('network.people') }}</a></li>
                                <li data-tab="tab-3" class="b-user-interface-content-nav__list tab-link"><a href="{{URL::to('search/content')}}@if($search_text){{'?search-text='.$search_text}}@endif">{{ trans('network.content') }}</a></li>
                                <!--li data-tab="tab-4" class="b-user-interface-content-nav__list tab-link"><a href="#">Группы</a></li>
                                <li data-tab="tab-5" class="b-user-interface-content-nav__list tab-link"><a href="#">Медиа</a></li-->
                                <div class="clear"></div>
                            </ul>
                        </div>
                        <div class="b-user-interface-content-item">
                            <p class="b-user-interface-content-item__place">{{ trans('network.place-to-search') }}</p>
                            <div class="b-user-interface-content-item__country">
                                {{Form::select('country', Country::getAllForView(), null, array('class' => 'selectpicker select-country form-control'))}}
                            </div>
                            <div class="b-user-interface-content-item__city">
                                {{Form::select('city', array('0' => trans("network.city")), null, array('class' => 'selectpicker select-city form-control'))}}
                            </div>
                             <div class="b-user-interface-content-item__nolist">
                                <input type="text" class="noinlist" value="Нет в списке">
                            </div>

                            <p class="b-user-interface-content-item__school-title">Учебные заведения</p>
                            <div class="b-user-interface-content-item__school">
                                @foreach(ProfileItem::getForViewMy('school') as $item)
                                    {{Form::radio('study', $item)}} {{$item}}<br>
                                @endforeach
                                @foreach(ProfileItem::getForViewMy('university') as $item)
                                    {{Form::radio('study', $item)}} {{$item}}<br>
                                @endforeach
                                {{Form::text('study_text', null, array('class' => 'form-control select-default school-item'))}}
                            </div>
                            <!-- <p class="b-user-interface-content-item__title">Место работы</p>
                            <div class="b-user-interface-content-item__item">
                                @foreach(ProfileItem::getForViewMy('job') as $item)
                                    {{Form::radio('study', $item)}} {{$item}}<br>
                                @endforeach
                                {{Form::text('job_text', null, array('class' => 'form-control select-default'))}}
                            </div> -->
                            <p class="b-user-interface-content-item__male-title">Пол</p>
                            <div class="b-user-interface-content-item__male">
                                <label>{{Form::radio('gender', 'male', null)}} {{ trans('network.gender-male') }}</label>
                            </div>
                            <div class="b-user-interface-content-item__female">
                                <label>{{Form::radio('gender', 'female', null)}} {{ trans('network.gender-female') }}</label>
                            </div>
                            <div class="b-user-interface-content-item__any">
                                <label>{{Form::radio('gender', 'other', null)}} {{ trans('network.any') }}</label>
                            </div>
                            <p class="b-user-interface-content-item__age-title">{{ trans('network.age') }}</p>
                            <div class="b-user-interface-content-item__age">
                                <label>от</label>
                                {{Form::select('age-from', $ageFrom, null, array('class' => 'input-default'))}}
                                <label>до</label>
                                {{Form::select('age-to', $ageTo, null, array('class' => 'input-default'))}}
                            </div>
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
        @include('scripts.countries-cities')
    </div>
</div>
@stop

@section('scripts')
    @include('search.scripts')
@stop