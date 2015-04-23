<?php

class AuthController extends BaseController {


    /**
     * Renders the 'Login' page
     */
	public function getLogin(){
        return View::make('login');
    }

    /**
     * Process the post login data
     */
    public function postLogin(){

        //  запускаем валидацию
        $rules = array('email' => 'required', 'password' => 'required');
        $validator = Validator::make(Input::all(), $rules);
        
        if($validator->fails()){
            return Redirect::to('login')->withErrors($validator);
        }
        
        // пробуем авторизовать пользователя
        $auth = Auth::attempt(array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        ), Input::get('remember'));
        
        // при неудачной авторизации отправляем на страницу логинка и выдаём ошибки
        if(!$auth){
            return Redirect::to('login')->withErrors(array(
                'Invalid credentials provided'
            ));
        }
        
        // Если пользователь не заполнил поля то отправляем его на страницу заполнения
        if(@Auth::user()->description->first_name == '' || @Auth::user()->description->gender == '' || @Auth::user()->description->liveplace_country_id == ''){
            return Redirect::to('profile/fill');
        }
        
        // направляем пользователя по первоначальному маршруту, либо на главную
        return Redirect::intended('/');
    }
    

    /**
     * Signs out the user
     */
    public function logout(){
        Auth::logout();
        return Redirect::to('/');
    }

    /**
     * Страница регистрации пользователя
     * 
     * @return [type] [description]
     */
    public function getRegister(){
        return View::make('register');
    }

    /**
     * Обработка post запроса с данными 
     * @return [type] [description]
     */
    public function postRegister(){

        // вытаскиваем правила для валидации
        $rules = User::$rules;

        // указываем валидатору какую БД использовать 
        $verifier = App::make('validation.presence');
        $verifier->setConnection('mysql_users');
        $validator = Validator::make(Input::all(), $rules);
        $validator->setPresenceVerifier($verifier);

        // проводим валидацию
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        // создаём нового юзера и сохраняем данные
        $user = User::newUser(Input::get('email'), Input::get('password'));
        
        // если юзер создан успешно, то создаём пустую запись с его дополнительными полями
        if($user->save()){
            User_Description::create(['user_id' => $user->id]);
            
            // создаём персональный блог пользователя
            $user->createPersonalBlog();

            // отправляем пользователю почту с активацией
            /*\Queue::push(
                Mail::send('emails.activate', array('user' => $user), function($message)
                {
                    $message->from('noreply@niamiko.com');
                    $message->to(Input::get('email'))->subject('Welcome!');
                })
            );*/

            // логиним пользователя и отправляем на заполнение профиля
            Auth::login($user);
            return Redirect::to('profile/fill');
        }

        return Redirect::back();
    }
    

    /**
     * Активируем учётную запись пользователя
     * 
     * @param  [type] $code [description]
     * @return [type]       [description]
     */
    public function getActivate($code){
        if(User::activate($code)){
            return Redirect::to('/login');
        }
        return Redirect::route('404');
    }

    public function loginWithFacebook() {
        // get data from input
        $code = Input::get( 'code' );
        // get fb service
        $fb = OAuth::consumer( 'Facebook' );

        // check if code is valid

        // if code is provided get user data and sign in
        if ( !empty( $code ) ) {

            // This was a callback request from facebook, get the token
            $token = $fb->requestAccessToken( $code );

            // Send a request with it
            $result = json_decode( $fb->request( '/me' ), true );

            $message = 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
            //echo $message. "<br/>";

            //Var_dump
            //display whole array().
            //dd($result);
            
            if(User::whereEmail($result['email'])->first()){
                // пробуем авторизовать пользователя
                $auth = Auth::attempt(array(
                        'email' => $result['email'],
                        'password' => $result['id'],
                            ), true);
            }else{
                $user = $this->saveSocialUser($result['email'], $result['first_name'], $result['last_name'], $result['gender']);
                // логиним пользователя и отправляем на заполнение профиля
                Auth::login($user);
            }
            return Redirect::to('profile/fill');
        }
        // if not ask for permission first
        else {
            // get fb authorization
            $url = $fb->getAuthorizationUri();

            // return to facebook login url
            return Redirect::to( (string)$url );
        }

/*

        $code = Input::get('code');
        $fb = OAuth::consumer( 'Facebook' ,'http://myhost.dev/login/fb');
        if ( !empty( $code ) ) {
            $token = $fb->requestAccessToken( $code );
            $result = json_decode( $fb->request( '/me' ), true );
            if ($user = User::where( 'social_id', '=' , $result['id']  )->first()) {
                Auth::login($user);
                return Redirect::to('profile');
            } else {
                $user = new User();
                $user->email = $result['email'];
                $user->social_id = $result['id'];
                $user->save();
                $profile = new UserProfile();
                $profile->firstname = $result['first_name'];
                $profile->lastname = $result['last_name'];
                $user->profile()->save($profile);
                Auth::login( $user );
                return Redirect::to('profile');
            }
        } else {
            $url = $fb->getAuthorizationUri();
            return Redirect::to((string)$url );
        }*/
    }

    public function loginWithVK(){
        $client_id = '4877440';                                                             // ID приложения
        $client_secret = '1BhtEnmkq4bmRfwCt4Og';                                            // Защищённый ключ
        $redirect_uri = 'http://localhost/newkyrgyz/public/login/vk';                       // Адрес сайта

        define('VK_APP_ID', $client_id);
        define('VK_APP_SECRET', $client_secret);
        define('VK_URL_CALLBACK', $redirect_uri);
        define('VK_URL_ACCESS_TOKEN', 'https://oauth.vk.com/access_token');
        define('VK_URL_AUTHORIZE', 'https://oauth.vk.com/authorize');
        define('VK_URL_GET_USER_INFO', 'https://api.vk.com/method/users.get');

        if(empty($_GET['code']))
        {
            return Redirect::to(VK_URL_AUTHORIZE.'?client_id='.VK_APP_ID.'&scope=offline'.'&redirect_uri='.urlencode(VK_URL_CALLBACK).'&response_type=code');
        }
        elseif(!empty($_GET['code'])) {
            if (!empty($_GET['error'])) {
                return Redirect::to('main/index');
            }
            if (!($res = @file_get_contents(VK_URL_ACCESS_TOKEN . '?client_id=' . VK_APP_ID . '&client_secret=' . VK_APP_SECRET . '&code=' . $_GET['code'] . '&redirect_uri=' . urlencode(VK_URL_CALLBACK)))){
                return Redirect::to('main/index');
            }
            $res = json_decode($res);
            if (!($vk_user = @file_get_contents(VK_URL_GET_USER_INFO.'?uid='.$res->user_id.'&v=5.30&access_token='.$res->access_token))){
                return Redirect::to('main/index');
            }
            $vk_user = json_decode($vk_user);

            // пробуем авторизовать пользователя
            $auth = Auth::attempt(array('email' => trim($vk_user->response[0]->id),'password' => trim($vk_user->response[0]->id)));

            if(!$auth) {
                //авторизация нового пользователя
                $user = new User;
                $user->email = trim($vk_user->response[0]->id);
                $user->password = Hash::make( trim($vk_user->response[0]->id) );

                if ($user->save()) {
                    $description = new User_Description;
                    $description->user_id = $user->id;
                    $description->first_name = $vk_user->response[0]->first_name;
                    $description->last_name = $vk_user->response[0]->last_name;
                    $description->save();

                    $user->createPersonalBlog();
                    // логиним пользователя и отправляем на заполнение профиля
                    Auth::login($user);
                    return Redirect::to('profile/fill');
                }
            }
            else{
                //авторизация существующего пользователя
                return Redirect::to('main/index');
            }
        }
    }

    public function saveSocialUser($email, $first_name, $last_name, $gender){
        
        // создаём нового юзера и сохраняем данные
        $user = new User;
        $user->email = $email;
        $user->password = Hash::make(str_random(30));
        $user->activated = true;

        // если юзер создан успешно, то создаём пустую запись с его дополнительными полями
        if ($user->save()) {
            $description = new User_Description;
            $description->user_id = $user->id;
            $description->first_name = $first_name;
            $description->last_name = $last_name;
            $description->gender = $gender;
            $description->gender_access = 'all';
            $description->save();

            // создаём персональный блог пользователя
            $user->createPersonalBlog();
            
            return $user;
        }
    }

    public function postAndroidLogin(){

        //  запускаем валидацию
        $rules = array('email' => 'required', 'password' => 'required');
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            exit('field_validation_fails');
        }

        // пробуем авторизовать пользователя
        $auth = Auth::attempt(array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        ), false);

        // при неудачной авторизации выдаём ошибку
        if(!$auth){
            exit('invalid_credentials_provided');
        }

        if(@Auth::user()->description->first_name == '' || @Auth::user()->description->gender == '' || @Auth::user()->description->liveplace_country_id == ''){
            exit('authorized!@#'.Auth::user()->remember_token.'!@#profile_needs_to_be_filled');
        }
        exit('authorized!@#'.Auth::user()->remember_token);
    }

}
