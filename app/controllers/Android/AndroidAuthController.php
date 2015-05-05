<?php

class AndroidAuthController extends BaseController{


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