<?php

class RatingController extends BaseController(){
	

	public function changeUserRating(){
		return Response::json(Input::all());
	}
	
}