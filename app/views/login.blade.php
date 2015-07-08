<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta charset="UTF-8"/>
        <title>{{Config::get('app.network_name')}}</title>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/style-login.css"/>
        <link rel="stylesheet" href="css/fonts-login.css"/>
        <link rel="stylesheet" href="css/rangeslider.css"/>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/rangeslider.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
    </head>
    <body>
        <div class="b-wrapper">
            <div class="b-page">
           
                <div class="b-header">
                    <div class="b-header__inner">
                        <div class="b-header__left">
                            <div class="b-header-logo">
                                    <div class="b-header-logo__image"><img src="img/login/1.png" alt=""/></div>
                                    <div class="b-header-logo__title">
                                        <div class="b-header-logo-title"><span class="b-header-logo-title__item">Национальные</span>
                                            <div class="b-header-logo-title__title">Я <span style="text-transform: capitalize;">{{trans('nation.'.Config::get('app.nation_name'))}}</span></div><span class="b-header-logo-title__soc">микросоциальные сети</span><span class="b-header-logo-title__beta">Beta</span>
                                            <p class="b-header-logo-title__link">
                                                Проект: <a href="">Niamiko.com</a>
                                            </p>
                                        </div>
                                    </div>
                                <div class="clear"></div>
                            </div>
                            <div class="b-header-title">
                                <div class="b-header-title__title">Мы все разные, но мы одна семья!</div>
                            </div>
                            <div class="b-header-tags">
                                Создай свой блог. Делись с друзьями фото, видео, музыкой 
                                Узнай больше о традициях и обычаях твоего народа		
                            </div>
                        </div>
                        <div class="b-header__right">
                            <div class="b-header-registration">
                                <div class="b-header-registration__top">
                                    <p>Еще не зарегистрировались?</p>
                                    <p>Присоединяйтесь к нам</p>
                                </div>
                                <div class="b-header-registration-button">
                                    <a href="{{URL::to('register')}}#bottom" style="text-decoration: none;">
                                        <input type="button" value="Регистрация" class="b-header-registration-button__button button-default"/>
                                    </a>
                                </div>
                                <div class="b-header-registration__social"><span>Войти через</span><img src="img/login/5.png" alt=""/><img src="img/login/4.png" alt=""/><img src="img/login/3.png" alt=""/></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="b-content">
                    <div class="b-authorization">
                      @foreach ($errors->all() as $error)
                <div class="b-message b-message-error">
                    <a href="javascript: $('.b-message').remove()" class="b-message-close"></a>
                    <div class="b-message-icon b-message-error-icon"></div>
                    <p class="b-message-p">
                        {{$error}}
                    </p>
                </div>
            @endforeach

                        <div class="b-authorization-inner">
                            <div class="b-authorization-inner-block">
                                <div class="b-authorization-inner-block__title">Авторизация</div>
                                <div class="b-authorization-inner-block-list">
                                    <ul>
                                        {{Form::open(array('url' => 'login'))}}
                                            <li class="b-authorization-inner-block-list__list">
                                                <div class="b-authorization-inner-block-list-login">
                                                    <p>Логин(email адрес)</p>
                                                    <input type="text" class="login registration-input" name="email"/>
                                                </div>
                                            </li>
                                            <li class="b-authorization-inner-block-list__list">
                                                <div class="b-authorization-inner-block-list-pass">
                                                    <p>Ваш пароль</p>
                                                    <input type="password" class="pass registration-input" name="password"/>
                                                </div>
                                            </li>
                                            <li class="b-authorization-inner-block-list__list third-child">
                                                <div class="b-authorization-inner-block-list-remember-me">
                                                    <input type="checkbox" name="remember"/><span class="remember-me">Запомнить меня</span>
                                                </div>
                                            </li>
                                            <li class="b-authorization-inner-block-list__list">
                                                <div class="b-authorization-inner-block-list-forget-pass">
                                                    <input type="submit" value="Войти" class="join-button button-default"/><a href="" class="forget-pass">Забыли пароль?</a>
                                                </div>
                                            </li>
                                        {{Form::close()}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="b-footer"></div>
            </div>
        </div>
    </body>
</html>

<!--<!DOCTYPE html>
<html lang="en">
	<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8"/>
		<title>{{Config::get('app.network_name')}}</title>
        <link rel="shortcut icon" href="{{ URL::to('img/favicon/favicon.ico') }}">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="{{URL::to('css/bootstrap.css')}}">
		<link rel="stylesheet" href="{{URL::to('css/login.css')}}">
		<script src="{{URL::to('js/library/jquery.min.js')}}"></script>
		<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
		@include('scripts.vote')
        @yield('scripts')
        <script src="{{URL::to('js/script.js')}}"></script>
        <script src="{{URL::to('js/dropit.js')}}"></script>
        <script src="{{URL::to('js/npm.js')}}"></script>
	</head>
	<body>
	    <div id="container">
	        @foreach ($errors->all() as $error)
	            <div class="b-message b-message-error">
                    <a href="javascript: $('.b-message').remove()" class="b-message-close"></a>
                    <div class="b-message-icon b-message-error-icon"></div>
                    <p class="b-message-p">
                        {{$error}}
                    </p>
                </div>
            @endforeach
            <section class="login">
                <div class="container login-container">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="login-form">
                                <span class="login-span1">{{ trans('nation.'.Config::get('app.nation_name').'_adjective') }} {{ trans('network.social-network') }}</span>
                                <span class="login-span2">{{ trans('network.join-us') }}</span>
                                <span class="login-span3">{{ trans('network.authorize') }}</span>
                                <div class="form-area">
                                    <div class="form">
                                        <div class="panel-body">
                                            {{Form::open(array('url' => 'login'))}}
                                                <fieldset>
                                                    <div class="form-group">
                                                        <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                                    </div>
                                                    <div class="checkbox" style="margin-left: 20px">
                                                        <input name="remember" type="checkbox" value="Remember Me">{{ trans('network.remember-me') }}
                                                    </div>
                                                    <button type="submit" name="submit_login" class="submit-button" id="login-form-submit">{{ trans('network.log-in') }}</button>
                                                </fieldset>
                                            {{Form::close()}}
                                            <a href="#registration" class="registration-button"  data-value="Войти">{{ trans('network.registration') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </section>
            <section class="line"></section>
            <section id="registration" class="registration">
                <div class="container registration-container">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="registration-form">

                                <span class="registration-span1">Войти через</span>
                                <div class="social-networks">
                                    <a href="{{ URL::to('login/vk') }}"><img src="{{URL::to('img/login/vk.png')}}"/></a>
                                    <a href="{{ URL::to('login/fb') }}"><img src="{{URL::to('img/login/f.png')}}"/></a>
                                    <a href="{{ URL::to('login/google') }}"><img src="{{URL::to('img/login/g.png')}}"/></a>
                                </div>

                                <span class="registration-span2">{{ trans('network.registration') }}</span>
                                <div class="form-area">
                                    <div class="form">
                                        <div class="panel-body">
                                            {{Form::open(array('url' => 'register'))}}
                                                <fieldset>
                                                    <div class="form-group">
                                                        <input class="form-control" placeholder="{{ trans('network.enter-email') }}" name="email" type="email" autofocus="">
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control pass" placeholder="{{ trans('network.enter-password') }}" name="password" type="password" value="">
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control pass-check" placeholder="{{ trans('network.repeat-password') }}" name="" type="password" value="">
                                                    </div>
                                                    <div class="form-group" style="margin-left: -15px">
                                                        {{Form::captcha(array('theme' => 'red'))}}
                                                    </div>
                                                    <button type="submit" id="registration-form-submit" class="submit-button" >{{ trans('network.do-register') }}</button>
                                                </fieldset>
                                            {{Form::close()}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>-->