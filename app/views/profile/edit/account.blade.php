@extends('misc.layout')
@extends('profile.edit.layout')
@section('form')
<div class="login-panel panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Учетная запись</h3>
    </div>
    <div class="panel-body">
        {{Form::open(array('url' => 'profile/edit/account'))}}
            <fieldset>
                <div class="all-alerts">
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        {{$error}}
                    </div>
                    @endforeach
                </div>
                <div class="form-group">
                    Логин:
                    {{Form::text('login', Auth::user()->name)}}
                </div>
                <div class="form-group">
                    Текущий пароль:
                    {{Form::password('password')}}<br>
                    Вы можете использовать латинские буквы, цифры и специальные символы ! @ # $ % ^ & * ( ) _ - +
                    в любом их сочетании. Пароль должен быть не короче 6 символов.<br>
                    Новый пароль {{Form::password('new_password')}}<br>
                    Повторите новый пароль {{Form::password('new_password_confirmation')}}<br>
                </div>
                {{Form::submit('Go!')}}
            </fieldset>
        {{Form::close()}}
    </div>
</div>
@stop