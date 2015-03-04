<?php

class AuthController extends BaseController {


    /**
     * Renders the 'Login' page
     */
	public function getLogin(){
        if(Auth::check()){
            return Redirect::to('main/index');
        }
        return View::make('login');
    }

    /**
     * Process the post login data
     */
    public function postLogin(){
        $rules = array('email' => 'required', 'password' => 'required');
        $validator = Validator::make(Input::all(), $rules);
        
        if($validator->fails()){
            return Redirect::to('login')->withErrors($validator);
        }
        
        $auth = Auth::attempt(array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        ), false);
        
        if(!$auth){
            return Redirect::to('login')->withErrors(array(
                'Invalid credentials provided'
            ));
        }
        
        if(@Auth::user()->description->first_name == '' || @Auth::user()->description->gender == '' || @Auth::user()->description->liveplace_country_id == ''){
            return Redirect::to('profile/fill');
        }
        
        return Redirect::intended();
    }
    

    /**
     * Signs out the user
     */
    public function Logout(){
        Auth::logout();
        return Redirect::to('/');
    }

    /**
     * Страница регистрации пользователя
     * 
     * @return [type] [description]
     */
    public function getRegister(){
        if(Auth::check()){
            return Redirect::to('main/index');
        }
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

        // генерируем код для активации пользователя
        $code = str_random(60);

        // создаём нового юзера и сохраняем данные
        $user = new User;
        $user->email    = Input::get('email');
        $user->password = Hash::make(Input::get('password'));
        $user->activation_code = $code;

        // если юзер создан успешно, то создаём пустую запись с его дополнительными полями
        if($user->save()){
            $description = new User_Description;
            $description->user_id = $user->id;
            $description->save();
            
            $user->createPersonalBlog();

            Mail::send('emails.activate', array('user' => $user), function($message)
            {
                $message->to(Input::get('email'))->subject('Welcome!');
            });
        }
        
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

}
