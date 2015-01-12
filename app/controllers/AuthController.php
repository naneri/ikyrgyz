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
        
        return Redirect::to('main/index');
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
        $rules = User::$rules;
        
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        $code = str_random(60);
        $user = new User;
        $user->email    = Input::get('email');
        $user->password = Hash::make(Input::get('password'));
        $user->activation_code = $code;
        if($user->save()){
            $description = new User_Description;
            $description->user_id = $user->id;
            $description->save();
            
        }
        
        return Redirect::to('/main/index');
    }

}
