<?php

class LoginController extends BaseController {


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
        
        return Redirect::to('blog/create');
    }
    

    /**
     * Signs out the user
     */
    public function getLogout(){
        Auth::logout();
        return Redirect::to('home');
    }

}
