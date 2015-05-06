<?php


class AuthController extends BaseController {


    public function __construct(UserRepository $user){
        parent::__construct();
        $this->user = $user;
    }

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
                'Неправильные данные доступа'
            ));
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

        // if code is not provided ask for permission first
        if ( empty( $code ) ) 
        {
            // get fb authorization
            $url = $fb->getAuthorizationUri();

            // return to facebook login url
            return Redirect::to( (string)$url );
        }
        // if provided get user data and sign in
        else 
        {
            // This was a callback request from facebook, get the token
            $token = $fb->requestAccessToken( $code );

            // Send a request with it
            $result = json_decode( $fb->request( '/me' ), true );
            
            $user = User::whereEmail($result['email'])->first();
            if(!$user)
            {
                $user = $this->saveSocialUser($result['email'], $result['first_name'], $result['last_name'], $result['gender']);
                
            }
            Auth::login($user);
            return Redirect::to('main/index');
        }
    }

    

}
