<?php


class AuthController extends BaseController {


    public function __construct(/*UserRepository $user*/){
        parent::__construct();
       /* $this->user = $user;*/
    }

    /**
     * Renders the 'Login' page
     */
	public function getLogin(){
        return $this->makeView('login');
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
                'Неправильные данные доступа'
            ));
        }

        BonsuRatingRepository::addDailyRating(Auth::user()->id, Config::get('bonus_rating.everyday_visit'));
        
        
        
        // направляем пользователя по первоначальному маршруту, либо на главную
        return Redirect::intended('/');
    }
    
    
    /**
     * Social login from niamiko
     */
    public function loginSocial() {

        $token = Input::get('token');

        $result = array();

        //проверяем, доступна ли функция file_get_contents. она необходима	для получения данных
        if (function_exists('file_get_contents') && ini_get('allow_url_fopen')) {
            $result = file_get_contents('http://ulogin.ru/token.php?token=' . $token .
                    '&host=niamiko.com');

            //если недоступна file_get_contents, пробуем использовать curl
        } elseif (in_array('curl', get_loaded_extensions())) {
            $request = curl_init('http://ulogin.ru/token.php?token=' . $token .
                    '&host=niamiko.com');
            curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($request);
        }

        $result = json_decode($result, true);

        $user = false;

        $email = $result['email'];

        $user = User::whereEmail($email)->first();
        if (!$user) {
            $user = $this->user->saveSocialUser($result['email'], $result['first_name'], $result['last_name'], $result['gender']);
        }
        
        Auth::login($user);
        return Redirect::to('profile/fill');
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
        return $this->makeView('register');
    }
    
    public function postRegisterRemote(){
        return $this->postRegister(true);
    }

    /**
     * Обработка post запроса с данными 
     * @return [type] [description]
     */
    public function postRegister($remote = false){

        // вытаскиваем правила для валидации
        $rules = User::$rules;
        
        if($remote){
            $rules['g-recaptcha-response'] = 'required|gRecaptchaVerify';
            Validator::extend('gRecaptchaVerify', function ($attribute, $captchaValue, $parameters) {
                $secretKey = Config::get('social.google-recaptcha-secret-key');
                $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $captchaValue . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);
                return $response['success'] == true;
            });
        } else {
            $rules['recaptcha_response_field'] = 'required|recaptcha';
        }
        $messages = array('gRecaptchaVerify' => 'Incorrect captcha form!');

        // указываем валидатору какую БД использовать 
        $verifier = App::make('validation.presence');
        $verifier->setConnection('mysql_users');
        $validator = Validator::make(Input::all(), $rules, $messages);
        $validator->setPresenceVerifier($verifier);

        // проводим валидацию
        if ($validator->fails()) {
            return $this->makeView('register');
        }

        // создаём нового юзера и сохраняем данные
        $user = User::newUser(Input::get('email'), Input::get('password'));
        $user->domain = Config::get('app.base_url');

        // если юзер создан успешно, то создаём пустую запись с его дополнительными полями
        if ($user->save()) {
            User_Description::create(['user_id' => $user->id]);

            // создаём персональный блог пользователя
            $user->createPersonalBlog();

            // отправляем пользователю почту с активацией
            /*Mail::send('emails.activate', array('user' => $user), function($message) {
                $message->from('noreply@niamiko.com');
                $message->to(Input::get('email'))->subject('Welcome!');
            });*/
        }

        // логиним пользователя и отправляем на заполнение профиля
        Auth::login($user);
        return Redirect::to('profile/fill');
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

    /**
     * Login with facebook
     * @return [type] [description]
     */
    public function loginWithFacebook() {
        
        // get data from input
        $code = Input::get( 'code' );
        // get fb service
        $fb = OAuth::consumer( 'Facebook' );

        // if code is not provided ask for permission first
        if ( empty( $code ) ) 
        {
            // get fb authorization
            $url = $fb->getAuthorizationUri();

            // return to facebook login url
            return Redirect::to( (string)$url );
        }
       
        // This was a callback request from facebook, get the token
        $token = $fb->requestAccessToken( $code );

        // Send a request with it
        $result = json_decode( $fb->request( '/me' ), true );
        
        $user = User::whereEmail($result['email'])->first();
        if(!$user)
        {
            $user = $this->user->saveSocialUser($result['email'], $result['first_name'], $result['last_name'], $result['gender']);
            
        }
        Auth::login($user);
        return Redirect::to('main/index');
        
    }

    /**
     * Login with Google
     * @return [type] [description]
     */
    public function loginWithGoogle() {

        // get data from input
        $code = Input::get( 'code' );

        // get google service
        $googleService = OAuth::consumer( 'Google' );

        // check if code is valid

        if ( empty( $code ) ) 
        {
            // get googleService authorization
            $url = $googleService->getAuthorizationUri();

            // return to google login url
            return Redirect::to( (string)$url );

        }
             
        // This was a callback request from google, get the token
        $token = $googleService->requestAccessToken( $code );

        // Send a request with it
        $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );

        $user = User::whereEmail($result['email'])->first();

        if(!$user)
        {
            $user = $this->user->saveSocialUser($result['email'], $result['given_name'], $result['family_name'], $result['gender']);
            
        }
        Auth::login($user);
        return Redirect::to('main/index');

    }
    
    /**
     * Login with Vkontakte
     * @return [type] [description]
     */
    public function loginWithVK()
    {

        // get data from input
        $code = Input::get( 'code' );

        // get google service
        $vkService = OAuth::consumer( 'Vkontakte' );

        // check if code is valid

        if ( empty( $code ) ) 
        {
            // get googleService authorization
            $url = $vkService->getAuthorizationUri();

            // return to google login url
            return Redirect::to( (string)$url );

        }
             
        // This was a callback request from google, get the token
        $token = $vkService->requestAccessToken( $code );

        // Send a request with it
        $result = json_decode( $vkService->request( 'https://api.vk.com/method/getProfiles' ), true );

        echo "<pre>"; print_r($result); echo "</pre>";exit;
        $user = User::whereEmail($result['email'])->first();

        if(!$user)
        {
            $user = $this->user->saveSocialUser($result['email'], $result['given_name'], $result['family_name'], $result['gender']);
            
        }
        Auth::login($user);
        return Redirect::to('main/index');

    }

}
