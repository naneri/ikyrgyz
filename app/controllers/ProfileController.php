<?php

class ProfileController extends BaseController {
    
        
        var $access = array('all' => 'Всем', 'friend' => 'Друзьям', 'me' => 'Только мне');
        var $profile_item_types = array('school', 'university', 'company', 'contact');

    /**
	 * Страница с профилем пользователя
	 * 
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getShow($id){
		$user = User::find($id);
		$friend_status = False;
		if(Friend::checkIfFriend($id, Auth::id())){
			$friend_status = True;
		}

		return View::make('profile.show', array('user' => $user, 'friend_status' => $friend_status));
	}

	/**
	 * Страница редактирования профиля
	 * 
	 * @return [type] [description]
	 */
	public function getEdit(){
		$user = User::with('description')->find(Auth::id());
		return View::make('profile.edit', array('user' => $user));
	}

	/**
	 * Обработка post запроса редактирования профиля
	 * 
	 * @return [type] [description]
	 */
	public function postEdit(){
		$user = User::find(Auth::id());
		$file = Input::file('image');
		$description_data = array('first_name' => Input::get('first_name'), 'last_name' => Input::get('last_name'), 'user_profile_about' => Input::get('about'));
		User_Description::update_data($description_data);
		return Redirect::back();
	}

	/**
	 * Список друзей пользователя
	 * 
	 * @return [type] [description]
	 */
	public function friends(){
		$friends = Friend::friendsList(Auth::id());
		return View::make('profile.friends', array('friends' => $friends));
	}
        
        public function getEditMain(){
            $user = User::with('description')->find(Auth::id());       
            return View::make('profile.edit.main', array('user' => $user, 'access' => $this->access));
        }
        
        public function postEditMain(){
            $description_data = Input::except(array('_token', 'day', 'month', 'year', 'image'));
            $description_data['birthday'] = Input::get('year').'-'.Input::get('month').'-'.Input::get('day');
            User_Description::update_data($description_data);
            return Redirect::back();
        }
        
        public function getEditStudy(){
            $user = User::with('description')->find(Auth::id());
            return View::make('profile.edit.study', array('user' => $user, 'access' => $this->access));
        }
        
        public function postStudySchool(){
            $rules = array(
                'school_name' => 'required',
                'year_begin' => 'date_format:Y',
                'year_end' => 'date_format:Y');
            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {
                return array('errors' => $validator->messages()->toJson());
            }
            
            $school = null;
            if(Input::has('school_id')){
                $school = ProfileItem::find(Input::get('school_id'));
            }
            if(!$school){
                $school = new ProfileItem();
                $school->user_id = Auth::id();
                $school->type = 'school';
            }
            $school->name = Input::get('school_name');
            $school->date_begin = Input::get('year_begin').'-00-00';
            $school->date_end = Input::get('year_end').'-00-00';
            $school->access = Input::get('school_access');
            $school->save();
            
            $result = View::make('profile.edit.build.schools', array('schools' => Auth::user()->schools, 'access' => $this->access))->render();
            return Response::json($result);
        }

        public function postStudyUniversity() {
            $rules = array(
                    'university_name' => 'required|min:3',
                    'year_begin' => 'date_format:Y',
                    'year_end' => 'date_format:Y',
                    'specitality' => 'alpha_num');
            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {
                return array('errors' => $validator->messages()->toJson());
            }

            $university = null;
            if (Input::has('university_id')) {
                $university = ProfileItem::find(Input::get('university_id'));
            }
            if (!$university) {
                $university = new ProfileItem();
                $university->user_id = Auth::id();
                $university->type = 'university';
            }
            $university->name = Input::get('university_name');
            $university->date_begin = date_create(Input::get('year_begin') . '-00-00');
            $university->date_end = date_create(Input::get('year_end') . '-00-00');
            $university->meta_1 = Input::get('speciality');
            $university->description = Input::get('description');
            $university->access = Input::get('university_access');
            $university->save();

            $result = View::make('profile.edit.build.universities', array('universities' => Auth::user()->universities, 'access' => $this->access))->render();
            return Response::json($result);
        }

}