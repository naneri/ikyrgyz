<?php

class ProfileController extends BaseController {

	public function getShow($id){
		$user = User::find($id);
		return View::make('profile.show', array('user' => $user));
	}

	public function getEdit($id){
		$user = User::find($id);
		return View::make('profile.edit', array('user' => $user));
	}
}