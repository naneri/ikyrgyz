<?php

class ProfileController extends BaseController {

	public function getShow($id){
		$user = User::find($id);
		return View::make('profile.show', array('user' => $user));
	}

	public function getEdit(){
		$user = User::find(Auth::id());
		return View::make('profile.edit', array('user' => $user));
	}

	public function postEdit(){
		$user = User::find(Auth::id());
		$file = Input::file('image');
		$result = User_Description::saveAvatar();
		return Redirect::back();
	}

	public function friends(){
		$friends = Friend::friendsList(Auth::id());
		return View::make('profile.friends', array('friends' => $friends));
	}
}