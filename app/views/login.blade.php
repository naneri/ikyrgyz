<!DOCTYPE html>
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
                                                    <div class="all-alerts">
                                                        @foreach ($errors->all() as $error)
                                                        <div class="alert alert-warning alert-dismissible" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                            {{$error}}
                                                        </div>
                                                        @endforeach
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
                                    <!--<a href="#"><img src="{{URL::to('img/login/vk.png')}}"/></a>-->
                                    <a href="{{ URL::to('login/fb')  }}"><img src="{{URL::to('img/login/f.png')}}"/></a>
                                    <!--<a href="#"><img src="{{URL::to('img/login/g.png')}}"/></a>-->
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
                                                    <div class="all-alerts">
                                                        @foreach ($errors->all() as $error)
                                                        <div class="alert alert-warning alert-dismissible" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                            {{$error}}
                                                        </div>
                                                        @endforeach
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
</html>