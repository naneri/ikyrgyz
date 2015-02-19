<?php

class ProfileController extends BaseController {
    
        
        var $access = array('all' => 'Всем', 'friend' => 'Друзьям', 'me' => 'Только мне');
        var $profileItemTypes = array('school', 'university', 'company', 'contact');
        var $familyMemberRelatives = array('NULL' => 'Член семьи', 'father' => 'Отец', 'mother' => 'Мама', 'brother' => 'Брат', 'sister' => 'Сестра', 'grandFather' => 'Дедушка', 'grandMother' => 'Бабушка','husband' => 'Муж', 'wife' => 'Жена', 'son' => 'Сын', 'doughter' => 'Дочь');
        var $maritalStatuses = array('NULL' => 'Семейное положение', 'single' => 'Без пары', 'married' => 'Женат/Замужем', 'separated' => 'В разводе', 'widowed' => 'Вдовец/Вдова');

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
            return View::make('profile.edit.study', array('access' => $this->access));
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
                $school = ProfileItem::where('id', Input::get('school_id'))
                            ->where('type', 'school')
                            ->where('user_id', Auth::id())
                            ->first();
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
                    'specitality' => '');
            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {
                return array('errors' => $validator->messages()->toJson());
            }

            $university = null;
            if (Input::has('university_id')) {
                $university = ProfileItem::where('id', Input::get('university_id'))
                                ->where('type', 'university')
                                ->where('user_id', Auth::id())
                                ->first();
        }
            if (!$university) {
                $university = new ProfileItem();
                $university->user_id = Auth::id();
                $university->type = 'university';
            }
            $university->name = Input::get('university_name');
            $university->date_begin = Input::get('year_begin') . '-00-00';
            $university->date_end = Input::get('year_end') . '-00-00';
            $university->meta_1 = Input::get('speciality');
            $university->description = Input::get('description');
            $university->access = Input::get('university_access');
            $university->save();

            $result = View::make('profile.edit.build.universities', array('universities' => Auth::user()->universities, 'access' => $this->access))->render();
            return Response::json($result);
        }

        public function getEditJob() {
            return View::make('profile.edit.job', array('access' => $this->access));
        }

        public function postJob() {
            $rules = array(
                'company_name' => 'required|min:3',
                'year_begin' => 'date_format:Y',
                'year_end' => 'date_format:Y',
                'job_title' => '');
            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {
                return array('errors' => $validator->messages()->toJson());
            }

            $job = null;
            if (Input::has('job_id')) {
                $job = ProfileItem::where('id', Input::get('job_id'))
                        ->where('type', 'job')
                        ->where('user_id', Auth::id())
                        ->first();
            }
            if (!$job) {
                $job = new ProfileItem();
                $job->user_id = Auth::id();
                $job->type = 'job';
            }
            $job->name = Input::get('company_name');
            $job->date_begin = Input::get('year_begin') . '-00-00';
            $job->date_end = Input::get('year_end') . '-00-00';
            $job->meta_1 = Input::get('job_title');
            $job->description = Input::get('description');
            $job->access = Input::get('job_access');
            $job->save();

            $result = View::make('profile.edit.build.jobs', array('jobs' => Auth::user()->jobs, 'access' => $this->access))->render();
            return Response::json($result);
        }

        public function getEditContact() {
            return View::make('profile.edit.contact', array('access' => $this->access));
        }

        public function postContact() {
            $rules = array('value' => 'required|min:3');
            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {
                return array('errors' => $validator->messages()->toJson());
            }
            
            $contact = null;
            if (Input::has('contact_id')) {
                $contact = ProfileItem::where('id', Input::get('contact_id'))
                        ->where('type', 'contact')
                        ->where('user_id', Auth::id())
                        ->first();
            }
            if (!$contact) {
                $contact = new ProfileItem();
                $contact->user_id = Auth::id();
                $contact->type = 'contact';
            }
            $contact->name = Input::get('contact_type');
            $contact->meta_1 = Input::get('value');
            $contact->access = Input::get('contact_access');
            $contact->save();
            
            $result = View::make('profile.edit.build.contacts', array('contacts' => Auth::user()->contacts()->where('name', Input::get('contact_type')), 'access' => $this->access))->render();
            return Response::json($result);
        }

        public function getEditFamily() {
            $user = User::with('description')->find(Auth::id());
            return View::make('profile.edit.family', array('access' => $this->access, 'relatives' => $this->familyMemberRelatives, 'maritalStatuses' => $this->maritalStatuses, 'user' => $user));
        }

        public function postFamilyMembers() {
            $rules = array('family_member_name' => 'required|min:3');
            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {
                return array('errors' => $validator->messages()->toJson());
            }
            
            if(!array_key_exists(Input::get('family_member_relative'), $this->familyMemberRelatives)){
                return array('errors' => 'error relative');
            }
            
            $member = null;
            if (Input::has('member_id')) {
                $member = ProfileItem::where('id', Input::get('member_id'))
                        ->where('type', 'family')
                        ->where('user_id', Auth::id())
                        ->first();
            }
            if (!$member) {
                $member = new ProfileItem();
                $member->user_id = Auth::id();
                $member->type = 'family';
            }
            $member->name = Input::get('family_member_relative');
            $member->meta_1 = Input::get('family_member_name');
            $member->access = Input::get('family_member_access');
            $member->save();

            $result = View::make('profile.edit.build.family', array('members' => Auth::user()->familyMembers, 'access' => $this->access, 'relatives' => $this->familyMemberRelatives))->render();
            return Response::json($result);
        }

        public function postMaritalStatus() {
            if (!array_key_exists(Input::get('marital_status'), $this->maritalStatuses)) {
                return array('errors' => 'error marital status');
            }

            $description_data = array('marital_status' => Input::get('marital_status'));
            User_Description::update_data($description_data);

            $result = array('success');
            return Response::json($result);
        }

        public function getEditAdditional() {
            $user = User::with('description')->find(Auth::id());
            return View::make('profile.edit.additional', array('access' => $this->access, 'user' => $user));
        }

        public function postAboutMe() {
            $description_data = array('about_me' => Input::get('about_me'));
            User_Description::update_data($description_data);

            $result = array('success');
            return Response::json($result);
        }

        public function postAdditional() {
            $rules = array('value' => 'required|min:3');
            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {
                return array('errors' => $validator->messages()->toJson());
            }
            
            if(!in_array(Input::get('additional_type'), array('passion', 'nickname'))){
                 return array('errors' => 'error additional type');
            }

            $additional = null;
            if (Input::has('additional_id')) {
                $additional = ProfileItem::where('id', Input::get('additional_id'))
                        ->where('type', 'additional')
                        ->where('user_id', Auth::id())
                        ->first();
            }
            if (!$additional) {
                $additional = new ProfileItem();
                $additional->user_id = Auth::id();
                $additional->type = 'additional';
            }
            $additional->name = Input::get('additional_type');
            $additional->meta_1 = Input::get('value');
            $additional->access = Input::get('additional_access');
            $additional->save();

            $result = View::make('profile.edit.build.additional', array('additionals' => Auth::user()->additionals()->where('name', Input::get('additional_type'))->get(), 'access' => $this->access))->render();
            return Response::json($result);
        }

}