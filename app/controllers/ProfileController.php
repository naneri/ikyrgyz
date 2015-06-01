<?php

class ProfileController extends BaseController {
    
        
        var $access = array( 'all' => 'Всем', 'friend' => 'Друзьям', 'me' => 'Только мне');
        var $profileItemTypes = array('school', 'university', 'company', 'contact');
        var $familyMemberRelatives = array('' => 'Член семьи', 'father' => 'Отец', 'mother' => 'Мама', 'brother' => 'Брат', 'sister' => 'Сестра', 'grandFather' => 'Дедушка', 'grandMother' => 'Бабушка','husband' => 'Муж', 'wife' => 'Жена', 'son' => 'Сын', 'doughter' => 'Дочь');
        var $maritalStatuses = array('' => 'Семейное положение', 'single' => 'Без пары', 'married' => 'Женат/Замужем', 'separated' => 'В разводе', 'widowed' => 'Вдовец/Вдова');
        var $month =  array("0" => "Месяц", "1" => "Январь", "2" => "Февраль", "3" => "Март", "4" => "Апрель", "5" => "Май", "6" => "Июнь", "7" => "Июль", "8" => "Август", "9" => "Сентябрь", "10" => "Октябрь", "11" => "Ноябрь", "12" => "Декабрь");
    protected $genders = array('male' => 'Мужской', 'female' => 'Женский');

    /**
	 * Страница с профилем пользователя
	 * 
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getShow($id, $page = 'newsline'){
		$user = User::findOrFail($id);
		$friend_status = False;
		if(Friend::checkIfFriend($id, Auth::id())){
			$friend_status = True;
		}
                
        $items = null;
        $videos = array();
        $photoAlbums = array();
        $videoIds = array();
        $topicsLimit = Config::get('topic.topics_per_page');
        $masonrySettings = array(
                'column' => $_COOKIE['ColumnN'] ? : Config::get('social.main_column_count'),
                'ajaxPage' => URL::to('topic/ajaxFavorites'),
        );
        
        switch($page){
            case 'publications':
                $items = $user->publications($topicsLimit);
                $videos = $user->topicsWithVideo()->take(6)->get();
                $photoAlbums = $user->photoAlbums()->with('photos')->orderBy('access')->take(6)->get();
                $masonrySettings['column'] = 'custom';
                $masonrySettings['columnWidth'] = 590;
                $masonrySettings['ajaxPage'] = URL::to('profile/'.$user->id.'/ajaxTopics/publications');
                break;
            case 'friends':
                $items = $user->friends();
                break;
            case 'mutualFriends':
                $items = $user->mutualFriends();
                break;
            case 'subscriptions':
                $items = $user->subscriptions();
                break;
            case 'subscribers':
                $items = $user->subscribers();
                break;
            case 'videos':
                $items = $user->topicsWithVideo;
                break;
            case 'favourites':
                if($user->id != Auth::id()){
                    return Redirect::to('profile/'.$user->id);
                }
                $items = Favourite::where('user_id', Auth::id())->get();
                //dd($items);
                break;
            case 'messages':
                $items = Auth::user()->messagesInbox()->orderBy('id', 'DESC')->paginate(20);
                break;
            case 'newsline':
            default:
                $items = $user->newsline($topicsLimit);
                $videos = $user->topicsWithVideo()->take(6)->get();
                $photoAlbums = $user->photoAlbums()->with('photos')->orderBy('access')->take(6)->get();
                $masonrySettings['ajaxPage'] = URL::to('profile/'.$user->id.'/ajaxTopics/newsline');
                break;
        }
        
        @$maritalStatus = $this->maritalStatuses[$user->description->marital_status];
        @$gender = $this->genders[$user->description->gender];
        
        foreach ($videos as $video) {
            preg_match("#([\/|\?|&]vi?[\/|=]|youtu\.be\/|embed\/)(\w+)#", $video->description, $matches);
            $videoIds[] = end($matches);
        }
    
        
        $friends = $user->friends();
        $subscribers = $user->subscribers();
        $photos = $user->photos();
        $videos = $user->topicsWithVideo;
        
        JavaScript::put($masonrySettings);

        if($user->id == Auth::id()){
            return View::make('profile.show.my', 
                    compact(
                            'user', 
                            'items', 
                            'page', 
                            'videoIds', 
                            'maritalStatus', 
                            'gender', 
                            'photoAlbums',
                            'friends',
                            'subscribers',
                            'photos',
                            'videos'
                            )
                    );
        }else{
            $mutualFriends = $user->mutualFriends();
            return View::make('profile.show.user', 
                    compact(
                            'user', 
                            'friend_status', 
                            'items', 'page', 
                            'videoIds', 
                            'maritalStatus', 
                            'gender', 
                            'photoAlbums', 
                            'friends', 
                            'subscribers', 
                            'photos',
                            'videos',
                            'mutualFriends'
                        )
                    );
        }
	}
        
    public function getAjaxsubscriptionBlogs($userId, $pageNum){
        $user = User::findOrFail($userId);
        $blogs = $user->subscriptions($pageNum);
        return View::make('blog.build', compact('blogs'));
    }

    public function ajaxTopics($userId, $pageName, $pageNumber = 0) {
        $user = User::find($userId);
        $topicsLimit = Config::get('topic.topics_per_page');
        $topics = array();
        if(!$pageNumber){
            $pageNumber = Input::get('page');
        }
        
        switch ($pageName) {
            case 'newsline':
            case 'profile':
                $topics = $user->newsline($topicsLimit, $pageNumber);
                break;
            case 'publications':
                $topics = $user->publications($topicsLimit, $pageNumber);
                break;
        }
        return View::make('topic.build', array('topics' => $topics));
    }

    public function showMyProfile($page = 'newsline'){
        return $this->getShow(Auth::id(), $page);
    }
    
    public function getRandom(){

        $friendIds = array();//Auth::user()->friends()->lists('id');

        array_push($friendIds, Auth::id());

        $userId = User::getRandomUser($friendIds);

        return Redirect::to('profile/'.$userId);
    }
    
    public function getProfileFill(){

        $user = User::with('description')->find(Auth::id());

        return View::make('profile.fill', array('user' => $user, 'access' => $this->access, 'month' => $this->month, 'genders' =>  $this->genders));
    }

    public function postProfileFill() {

        $rules = array(
            'first_name' => 'required',
            'gender' => 'required',
            'live_country' => 'required',
            'live_city' => 'required',
            'birth_country' => 'required',
            'birth_city' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $description_data = Input::except(array('_token', 'day', 'month', 'year', 'image'));

        $description_data['birthday'] = ((Input::has('year')) ? Input::get('year') : '0000') . '-' . (Input::has('month') ? Input::get('month') : '00') . '-' . (Input::has('day') ? Input::get('day') : '00');

        $description_data['live_country'] = Input::get('live_country');
        $description_data['live_city'] = Input::get('live_city');
        $description_data['birth_country'] = Input::get('birth_country');
        $description_data['birth_city'] = Input::get('birth_city');

        User_Description::updateProfile($description_data, Auth::user()->id);
        User_Description::updateProfileLocationDataByIds($description_data, Auth::user()->id);

        return Redirect::to('main/index');
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

    private function getProfileItem($profileItemType, $profileItemSubType, $profileItemId) {
        $profileItem = null;
        if ($profileItemId) {
            $profileItem = ProfileItem::where('id', $profileItemId)
                    ->where('type', $profileItemType)
                    ->where('subtype', $profileItemSubType)
                    ->where('user_id', Auth::id())
                    ->first();
        }
        if (!$profileItem) {
            $profileItem = new ProfileItem();
            $profileItem->user_id = Auth::id();
            $profileItem->type = $profileItemType;
            $profileItem->subtype = $profileItemSubType;
        }
        return $profileItem;
    }

    public function getEditAccount() {
        $user = User::with('description')->find(Auth::id());
        return View::make('profile.edit.account', array('user' => $user, 'access' => $this->access));
    }

    public function postEditAccount() {
        $rules = array(
            'login' => 'alpha_num|between:3,50',
            'new_password' => 'string|between:6,50|confirmed',
            'new_password_confirmation' => 'string|between:6,50');
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        $user = Auth::user();
        $user->name = Input::get('login');
        if(Input::has('password')){
            if(Hash::check(Input::get('password'), $user->password)){
                $user->password = Hash::make(Input::get('new_password'));
            } else {
                return Redirect::back()->withErrors(array('Invalid current password!'));
            }
        }
        $user->save();
        return Redirect::back();
    }

    public function getEditMain(){
        
        $user = User::with('description')->find(Auth::id());
        
        $birthdayExploded = explode('-', $user['description']->birthday);
        $birthday['year'] = $birthdayExploded[0];
        $birthday['month'] = $birthdayExploded[1];
        $birthday['day'] = $birthdayExploded[2];
        
        $days = ['0' => 'День'];
        for ($day = 1; $day < 32; $day++) {
            $days[$day] = $day;
        }
        
        $startYear = (int) date('Y');
        $endYear = (int) date('Y') - 100;
        $years = ['0' => 'Год'];
        for ($year = $startYear; $year > $endYear; $year--) {
            $years[$year] = $year;
        }; 
        
        return View::make('profile.edit.main', array('user' => $user, 'access' => $this->access, 'month' => $this->month, 'birthday' => $birthday, 'days' => $days, 'years' => $years));
    }
    
    public function postEditMain(){
        $rules = array(
            'first_name' => 'required',
            'gender' => 'required',
            'liveplace_country_id' => 'required');
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $description_data = Input::except(array('_token', 'day', 'month', 'year', 'image'));
        $description_data['birthday'] = ((Input::has('year'))?Input::get('year'):'0000').'-'.(Input::has('month')?Input::get('month'):'00').'-'.(Input::has('day')?Input::get('day'):'00');
        User_Description::update_data($description_data);
        return Redirect::back();
    }
    
    public function uploadAvatar(){
        if(Input::hasFile('avatar')){
            $data['user_profile_avatar'] = User_Description::saveAvatar(Input::file('avatar'));
            User_Description::update_data($data);
        }
        return Redirect::to('profile');
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
        
        $school = $this->getProfileItem('study', 'school', Input::get('school_id'));
        $school->value = Input::get('school_name');
        $school->date_begin = Input::get('year_begin').'-00-00';
        $school->date_end = Input::get('year_end').'-00-00';
        $school->access = $this->validateAccess(Input::get('school_access'));
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

        $university = $this->getProfileItem('study', 'university', Input::get('university_id'));
        $university->value = Input::get('university_name');
        $university->date_begin = Input::get('year_begin') . '-00-00';
        $university->date_end = Input::get('year_end') . '-00-00';
        $university->meta_1 = Input::get('speciality');
        $university->description = Input::get('description');
        $university->access = $this->validateAccess(Input::get('university_access'));
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

        $job = $this->getProfileItem('experience', 'job', Input::get('job_id'));
        $job->value = Input::get('company_name');
        $job->date_begin = Input::get('year_begin') . '-00-00';
        $job->date_end = Input::get('year_end') . '-00-00';
        $job->meta_1 = Input::get('job_title');
        $job->description = Input::get('description');
        $job->access = $this->validateAccess(Input::get('job_access'));
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
        
        if(!in_array(Input::get('contact_type'), array('phone', 'email', 'address', 'messenger'))){
            return array('errors' => 'contact type error!');
        }
        
        $contact = $this->getProfileItem('contact', Input::get('contact_type'), Input::get('contact_id'));
        $contact->value = Input::get('value');
        $contact->access = $this->validateAccess(Input::get('contact_access'));
        $contact->save();
        
        $result = View::make('profile.edit.build.contacts', array('contacts' => Auth::user()->contacts()->where('subtype', Input::get('contact_type'))->get(), 'access' => $this->access))->render();
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
        
        $member = $this->getProfileItem('family', Input::get('family_member_relative'), Input::get('member_id'));
        $member->value = Input::get('family_member_name');
        $member->access = $this->validateAccess(Input::get('family_member_access'));
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

        $additional = $this->getProfileItem('additional', Input::get('additional_type'), Input::get('additional_id'));
        $additional->value = Input::get('value');
        $additional->access = $this->validateAccess(Input::get('additional_access'));
        $additional->save();

        $result = View::make('profile.edit.build.additional', array('additionals' => Auth::user()->additionals()->where('subtype', Input::get('additional_type'))->get(), 'access' => $this->access))->render();
        return Response::json($result);
    }
    
    public function getEditAccess() {
        $user = User::with('description')->find(Auth::id());
        return View::make('profile.edit.access', array('access' => $this->access, 'user' => $user));
    }

    public function postAccess() {
        $rules = array();
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return array('errors' => $validator->messages()->toJson());
        }
        
        $userDescriptionData = Input::only(
                'names_access',
                'gender_access',
                'birthday_access',
                'liveplace_access',
                'birthplace_access',
                'about_me_access', 
                'marital_status_access'
                );
        User_Description::where('user_id', Auth::id())->update($userDescriptionData);
        
        $subtypesAccess = Input::only(
                'school_access',
                'university_access',
                'job_access',
                'phone_access',
                'email_access',
                'address_access',
                'messenger_access',
                'passion_access',
                'nickname_access');
        foreach($subtypesAccess as $subtypeAccess =>$value){
            $typeName = explode('_', $subtypeAccess)[0];
            if(array_key_exists($value, $this->access)){
                Auth::user()->profileItems()->where('subtype', $typeName)->update(array('access' => $value));
            }
        }
        
        if (array_key_exists(Input::get('family_access'), $this->access)) {
            Auth::user()->profileItems()->where('type', 'family')->update(array('access' => Input::get('family_access')));
        }
        
        return Redirect::back();
    }
    
    private function validateAccess($access){
        $correctAccess = null;
        if(array_key_exists($access, $this->access)){
            $correctAccess = $access;
        } else {
            $correctAccess = 'me';
        }
        return $correctAccess;
    }

    public function postEditAvatar(){
        $crop = new CropAvatar(Input::get('avatar_src'), Input::get('avatar_data'), $_FILES['avatar_file']);

        $response = array(
            'state' => 200,
            'message' => $crop->getMsg(),
            'result' => asset($crop->getResult())
        );
        
        if(!$crop->getMsg()){
            User_Description::where('user_id', Auth::id())->update(array('user_profile_avatar' => asset($crop->getResult())));
        }

        return Response::json($response);
    }


}
