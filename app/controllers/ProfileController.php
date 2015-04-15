<?php

class ProfileController extends BaseController {
    
        
        var $access = array( 'all' => 'Всем', 'friend' => 'Друзьям', 'me' => 'Только мне');
        var $profileItemTypes = array('school', 'university', 'company', 'contact');
        var $familyMemberRelatives = array('' => 'Член семьи', 'father' => 'Отец', 'mother' => 'Мама', 'brother' => 'Брат', 'sister' => 'Сестра', 'grandFather' => 'Дедушка', 'grandMother' => 'Бабушка','husband' => 'Муж', 'wife' => 'Жена', 'son' => 'Сын', 'doughter' => 'Дочь');
        var $maritalStatuses = array('' => 'Семейное положение', 'single' => 'Без пары', 'married' => 'Женат/Замужем', 'separated' => 'В разводе', 'widowed' => 'Вдовец/Вдова');
        var $month =  array("0" => "Месяц", "1" => "Январь", "2" => "Февраль", "3" => "Март", "4" => "Апрель", "5" => "Май", "6" => "Июнь", "7" => "Июль", "8" => "Август", "9" => "Сентябрь", "10" => "Октябрь", "11" => "Ноябрь", "12" => "Декабрь");
        var $genders = array('male' => 'Мужской', 'female' => 'Женский');

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
                switch($page){
                    case 'publications':
                        $items = $user->publications($topicsLimit);
                        break;
                    case 'friends':
                        $items = $user->friends();
                        break;
                    case 'mutualFriends':
                        $items = $user->mutualFriends();
                        break;
                    case 'subscribtions':
                        $items = $user->subscribtions();
                        break;
                    case 'subscribers':
                        $items = $user->subscribers();
                        break;
                    case 'videos':
                        $items = $user->topicsWithVideo;
                        break;
                    case 'newsline':
                    default:
                        $items = $user->newsline($topicsLimit);
                        $videos = $user->topicsWithVideo()->take(6)->get();
                        $photoAlbums = $user->photoAlbums()->with('photos')->orderBy('access')->take(6)->get();
                        break;
                }
                
                @$maritalStatus = $this->maritalStatuses[$user->description->marital_status];
                @$gender = $this->genders[$user->description->gender];
                
                foreach ($videos as $video) {
                    preg_match("#([\/|\?|&]vi?[\/|=]|youtu\.be\/|embed\/)(\w+)#", $video->description, $matches);
                    $videoIds[] = end($matches);
                }
                
                if (!isset($_COOKIE['ColumnN'])) {
                    $_COOKIE['ColumnN'] = '2';
                }
                if($user->id == Auth::id()){
                    return View::make('profile.show.my', compact('user', 'items', 'page', 'videoIds', 'maritalStatus', 'gender', 'photoAlbums'));
                }else{
                    return View::make('profile.show.user', compact('user', 'friend_status', 'items', 'page', 'videoIds', 'maritalStatus', 'gender', 'photoAlbums'));
                }
	}

        public function ajaxTopics($userId, $pageName, $pageNumber = 0) {
            $user = User::find($userId);
            $topicsLimit = Config::get('topic.topics_per_page');
            $topics = array();
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
            $userId = User::whereHas('description', function($query){
                                $query->where('user_profile_avatar', '!=', 'NULL');
                            })
                            ->whereNotIn('id', $friendIds)
                            ->orderByRaw("RAND()")
                            ->first()
                            ->id;
            return Redirect::to('profile/'.$userId);
        }
        
        public function getProfileFill(){
            $user = User::with('description')->find(Auth::id());
            return View::make('profile.fill', array('user' => $user, 'access' => $this->access, 'month' => $this->month));
        }

        public function postProfileFill() {
            $rules = array(
                'first_name' => 'required',
                'gender' => 'required',
                'liveplace_country_id' => 'required');
            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            $description_data = Input::except(array('_token', 'day', 'month', 'year', 'image'));
            $description_data['birthday'] = ((Input::has('year')) ? Input::get('year') : '0000') . '-' . (Input::has('month') ? Input::get('month') : '00') . '-' . (Input::has('day') ? Input::get('day') : '00');
            User_Description::update_data($description_data);
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

        public function getRandomOld(){
            $users = DB::connection('mysql_users')->statement("SELECT * FROM `users` WHERE id >= (SELECT FLOOR( MAX(id) * RAND()) FROM `users` ) ORDER BY id LIMIT 1;");
            echo "<pre>"; print_r($users); echo "</pre>";exit;
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

class CropAvatar {

    private $src;
    private $data;
    private $file;
    private $dst;
    private $type;
    private $extension;
    private $srcDir = 'uploads/user/avatar/original';
    private $dstDir = 'uploads/user/avatar/cropped';
    private $msg;

    function __construct($src, $data, $file) {
        $this->setSrc($src);
        $this->setData($data);
        $this->setFile($file);
        $this->crop($this->src, $this->dst, $this->data);
    }

    private function setSrc($src) {
        if (!empty($src)) {
            $type = exif_imagetype($src);

            if ($type) {
                $this->src = $src;
                $this->type = $type;
                $this->extension = image_type_to_extension($type);
                $this->setDst();
            }
        }
    }

    private function setData($data) {
        if (!empty($data)) {
            $this->data = json_decode(stripslashes($data));
        }
    }

    private function setFile($file) {
        $errorCode = $file['error'];

        if ($errorCode === UPLOAD_ERR_OK) {
            $type = exif_imagetype($file['tmp_name']);

            if ($type) {
                $dir = $this->srcDir;

                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }

                $extension = image_type_to_extension($type);
                $src = $dir . '/' . date('YmdHis') . $extension;

                if ($type == IMAGETYPE_GIF || $type == IMAGETYPE_JPEG || $type == IMAGETYPE_PNG) {

                    if (file_exists($src)) {
                        unlink($src);
                    }

                    $result = move_uploaded_file($file['tmp_name'], $src);

                    if ($result) {
                        $this->src = $src;
                        $this->type = $type;
                        $this->extension = $extension;
                        $this->setDst();
                    } else {
                        $this->msg = 'Failed to save file';
                    }
                } else {
                    $this->msg = 'Please upload image with the following types: JPG, PNG, GIF';
                }
            } else {
                $this->msg = 'Please upload image file';
            }
        } else {
            $this->msg = $this->codeToMessage($errorCode);
        }
    }

    private function setDst() {
        $dir = $this->dstDir;

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $this->dst = $dir . '/' . date('YmdHis') . '.png';
    }

    private function crop($src, $dst, $data) {
        if (!empty($src) && !empty($dst) && !empty($data)) {
            switch ($this->type) {
                case IMAGETYPE_GIF:
                    $src_img = imagecreatefromgif($src);
                    break;

                case IMAGETYPE_JPEG:
                    $src_img = imagecreatefromjpeg($src);
                    break;

                case IMAGETYPE_PNG:
                    $src_img = imagecreatefrompng($src);
                    break;
            }

            if (!$src_img) {
                $this->msg = "Failed to read the image file";
                return;
            }

            $size = getimagesize($src);
            $size_w = $size[0]; // natural width
            $size_h = $size[1]; // natural height

            $src_img_w = $size_w;
            $src_img_h = $size_h;

            $degrees = $data->rotate;

            // Rotate the source image
            if (is_numeric($degrees) && $degrees != 0) {
                // PHP's degrees is opposite to CSS's degrees
                $new_img = imagerotate($src_img, -$degrees, imagecolorallocatealpha($src_img, 0, 0, 0, 127));

                imagedestroy($src_img);
                $src_img = $new_img;

                $deg = abs($degrees) % 180;
                $arc = ($deg > 90 ? (180 - $deg) : $deg) * M_PI / 180;

                $src_img_w = $size_w * cos($arc) + $size_h * sin($arc);
                $src_img_h = $size_w * sin($arc) + $size_h * cos($arc);

                // Fix rotated image miss 1px issue when degrees < 0
                $src_img_w -= 1;
                $src_img_h -= 1;
            }

            $tmp_img_w = $data->width;
            $tmp_img_h = $data->height;
            $dst_img_w = 220;
            $dst_img_h = 220;

            $src_x = $data->x;
            $src_y = $data->y;

            if ($src_x <= -$tmp_img_w || $src_x > $src_img_w) {
                $src_x = $src_w = $dst_x = $dst_w = 0;
            } else if ($src_x <= 0) {
                $dst_x = -$src_x;
                $src_x = 0;
                $src_w = $dst_w = min($src_img_w, $tmp_img_w + $src_x);
            } else if ($src_x <= $src_img_w) {
                $dst_x = 0;
                $src_w = $dst_w = min($tmp_img_w, $src_img_w - $src_x);
            }

            if ($src_w <= 0 || $src_y <= -$tmp_img_h || $src_y > $src_img_h) {
                $src_y = $src_h = $dst_y = $dst_h = 0;
            } else if ($src_y <= 0) {
                $dst_y = -$src_y;
                $src_y = 0;
                $src_h = $dst_h = min($src_img_h, $tmp_img_h + $src_y);
            } else if ($src_y <= $src_img_h) {
                $dst_y = 0;
                $src_h = $dst_h = min($tmp_img_h, $src_img_h - $src_y);
            }

            // Scale to destination position and size
            $ratio = $tmp_img_w / $dst_img_w;
            $dst_x /= $ratio;
            $dst_y /= $ratio;
            $dst_w /= $ratio;
            $dst_h /= $ratio;

            $dst_img = imagecreatetruecolor($dst_img_w, $dst_img_h);

            // Add transparent background to destination image
            imagefill($dst_img, 0, 0, imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
            imagesavealpha($dst_img, true);

            $result = imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

            if ($result) {
                if (!imagepng($dst_img, $dst)) {
                    $this->msg = "Failed to save the cropped image file";
                }
            } else {
                $this->msg = "Failed to crop the image file";
            }

            imagedestroy($src_img);
            imagedestroy($dst_img);
        }
    }

    private function codeToMessage($code) {
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
                $message = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
                break;

            case UPLOAD_ERR_FORM_SIZE:
                $message = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
                break;

            case UPLOAD_ERR_PARTIAL:
                $message = 'The uploaded file was only partially uploaded';
                break;

            case UPLOAD_ERR_NO_FILE:
                $message = 'No file was uploaded';
                break;

            case UPLOAD_ERR_NO_TMP_DIR:
                $message = 'Missing a temporary folder';
                break;

            case UPLOAD_ERR_CANT_WRITE:
                $message = 'Failed to write file to disk';
                break;

            case UPLOAD_ERR_EXTENSION:
                $message = 'File upload stopped by extension';
                break;

            default:
                $message = 'Unknown upload error';
        }

        return $message;
    }

    public function getResult() {
        return !empty($this->data) ? $this->dst : $this->src;
    }

    public function getMsg() {
        return $this->msg;
    }

}
