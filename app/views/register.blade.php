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
                    <div class="b-header__inner b-header__inner_default-padding">
                        <div class="b-header__left_login">
                            <div class="b-header-logo"><a href="#">
                                    <div class="b-header-logo__image"><img src="img/login/1.png" alt=""/></div>
                                    <div class="b-header-logo__title">
                                        <div class="b-header-logo-title">										
                                            <div class="b-header-logo-title__title b-header-logo-title__title_font25"> Национальные
                                                <p>микросоциальные сети</p>
                                            </div><span class="b-header-logo-title__beta b-header-logo-title__beta_login">Beta</span>
                                            <div class="clear"></div>
                                        </div>
                                    </div></a></div>
                        </div>
                        <div class="b-header__right_login">
                            {{Form::open(array('url' => 'login'))}}
                            <div class="b-header-login">
                                <div class="b-header-login__top">Я уже зарегестрирован</div>
                                <div class="b-header-login__middle">
                                    <div class="b-header-login-join">
                                        <div class="b-header-login-join__text">Логин(email адрес)</div>
                                        <div class="b-header-login-join__login">
                                            <input type="text" name="email"/>
                                        </div>
                                    </div>
                                    <div class="b-header-login-join">
                                        <div class="b-header-login-join__text">Пароль</div>
                                        <div class="b-header-login-join__login">
                                            <input type="password" name="password" />
                                        </div>
                                    </div>
                                    <div class="b-header-login-button">
                                        <form>
                                            <input type="submit" value="Войти" class="b-header-login-button__button button-default"/>
                                        </form>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            {{Form::close()}}
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="b-header-bottom">
                        <div class="b-header-bottom__left">
                            <div class="b-header-title">
                                <div class="b-header-title__title">Мы все разные, но мы одна семья!</div>
                            </div>
                            <div class="b-header-tags">
                                Создай свой блог. Делись с друзьями фото, видео, музыкой 
                                Узнай больше о традициях и обычаях твоего народа		
                            </div>
                        </div>
                        <div class="b-header-bottom__right">
                            <div class="b-header-bottom-social"><span>Войти через</span><img src="img/login/5.png" alt=""/><img src="img/login/4.png" alt=""/><img src="img/login/3.png" alt=""/></div>
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
                                <div class="b-authorization-inner-block__title" id="bottom">Регистрация</div>
                                <div class="b-authorization-inner-block-list">
                                    <ul>
                                        {{Form::open(array('url' => 'register'))}}
                                            <li class="b-authorization-inner-block-list__list">
                                                <div class="b-authorization-inner-block-list-country"><img src="img/login/8.png" alt="" class="ya-img"/>
                                                    <select name="" class="select-country">
                                                        <option value="">{{trans('nation.'.Config::get('app.nation_name'))}}</option>
                                                    </select>
                                                </div>
                                            </li>
                                            <li class="b-authorization-inner-block-list__list">
                                                <div class="b-authorization-inner-block-list-login">
                                                    <p>Введите ваш email</p>
                                                    <input name="email" type="text" class="login registration-input"/>
                                                </div>
                                            </li>
                                            <li class="b-authorization-inner-block-list__list">
                                                <div class="b-authorization-inner-block-list-pass">
                                                    <p>Ваш пароль</p>
                                                    <input name="password" type="password" class="pass registration-input"/>
                                                </div>
                                            </li>
                                            <li class="b-authorization-inner-block-list__list">
                                                <div class="b-authorization-inner-block-list-repeat">
                                                    <p>Повторите пароль</p>
                                                    <input name="password_confirmation" type="password" class="pass registration-input"/>
                                                </div>
                                            </li>
                                            <li class="b-authorization-inner-block-list__list">
                                                <div class="b-authorization-inner-block-list-captcha">
                                                    {{Form::captcha(array('theme' => 'red'))}}
                                                </div>
                                            </li>
                                            <li class="b-authorization-inner-block-list__list">											
                                                <div class="b-authorization-inner-block-list-btn">												
                                                    <input type="submit" value="Зарегистрироваться" class="join-button button-default"/>
                                                </div>
                                            </li>
                                        {{Form::close()}}
                                    </ul>

                                </div>
                            </div>
                          <!--   <div class="b-authorization-inner-form">
                                <div class="b-authorization-inner-form-top">
                                    <div class="b-authorization-inner-form-top__title">Выберите нацию</div>
                                    <div class="b-authorization-inner-form-top__button"><button class="btn btn-close"></button></div>
                                    <div class="clear"></div>

                                </div>
                                <div class="b-authorization-inner-form-bottom">
                                    <img src="img/login/8.png" alt="" class="b-authorization-inner-form-bottom__image">
                                    <select name=""  class="b-authorization-inner-form-bottom__select"></select>
                                    <div class="b-authorization-inner-form-bottom__button">
                                        <a href="" class="btn-submit">Выбрать</a>
                                    </div>
                                </div>
                            
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="b-footer"></div>
        </div>
    </body>
</html>