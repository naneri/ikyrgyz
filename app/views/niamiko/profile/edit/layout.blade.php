@section('content')
{{HTML::style('css/bootstrap.css')}}
<div class="b-content">
    <div class="col-md-4 edit-nav">
        <h4>Информация о вас</h4>
        {{HTML::link('profile/edit/account', 'Учетная запись')}}
        {{HTML::link('profile/edit/main', 'Основная')}}
        {{HTML::link('profile/edit/study', 'Образование')}}
        {{HTML::link('profile/edit/job', 'Работа')}}
        {{HTML::link('profile/edit/contact', 'Контакты')}}
        {{HTML::link('profile/edit/family', 'Семья')}}
        {{HTML::link('profile/edit/additional', 'Дополнительно')}}
        {{HTML::link('profile/edit/access', 'Настройка публичности')}}
    </div>
    <div class="col-md-8">
        @yield('form')
    </div>
</div>
<style>
    .edit-nav {
        width: 25%;
        float: left;
    }
    .edit-nav a{
        display: block;
    }
</style>
@stop