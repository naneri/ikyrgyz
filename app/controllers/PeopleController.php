<?php

class PeopleController extends BaseController{

	public function index(){
			
			if(Input::get('email')){
				User::where('email', 'like', Input::get('email'));
			}else{
				$users = User::paginate(15);
			}
			
			return View::make('people.index', array('users' => $users));
	}


}