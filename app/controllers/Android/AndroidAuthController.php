<?php

class AndroidAuthController extends BaseController{


	public function postAndroidLogin(){

        //  запускаем валидацию
        $rules = array('email' => 'required', 'password' => 'required');
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()) {
            echo json_encode(array('logged_in' => '0', 'error' => 'Неверный e-mail или пароль'));
            exit;
        }

        // пробуем авторизовать пользователя
        $auth = Auth::attempt(array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        ), false);

        // при неудачной авторизации выдаём ошибку
        if(!$auth){
            echo json_encode(array('logged_in' => '0', 'error' => 'Неверный e-mail или пароль'));
            exit;
        }

        echo json_encode(array('logged_in' => '1', 'error' => ''));
        // Auth::user()->remember_token;
    }

    
}