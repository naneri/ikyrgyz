<?php

Class Blog extends Eloquent{

        public static $rules = array(
            'title' => 'required', 
            'description' => 'required',
            'type_id' => 'required'
        );
        
        protected $fillable = ['title', 'description', 'type_id', 'user_id'];
        
        public function user() {
            return $this->belongsTo('User', 'user_id');
        }

        public function author(){
            return $this->belongsTo('User', 'user_id');
        }
        
        public function topics(){
            return $this->hasMany('Topic');
        }
        
        public function isAdminCurrentUser(){
            $adminRoleId = Role::whereName('admin')->first()->id;
            $userId = Auth::user()->id;
            return $this->checkRole($userId, $adminRoleId) || Auth::user()->is_admin;
        }
        
        public function isModeratorCurrentUser(){
            $moderatorRoleId = Role::whereName('moderator')->first()->id;
            $userId = Auth::user()->id;
            return $this->checkRole($userId, $moderatorRoleId) || $this->isAdminCurrentUser();
        }
        
        private function checkRole($userId, $roleId){
            return DB::table('blog_roles')
                ->where('role_id', $roleId)
                ->where('blog_id', $this->id)
                ->where('user_id', $userId)
                ->exists();
        }
        
        public function canEdit(){
            $canEdit = null;
            if($this->type->name == 'personal'){
                $canEdit = ($this->user_id == Auth::user()->id);
            } else {
                $canEdit = $this->isAdminCurrentUser();
            }
            return $canEdit;
        }
        
        public function isUserHaveRole(){
            return BlogRole::where('blog_id', $this->id)
                    ->where('user_id', Auth::user()->id)
                    ->exists() || Auth::user()->id == $this->user_id;
        }
        
        public function getCreator(){
            return User::whereId($this->user_id)->first();
        }
        
        public function getAdmins(){
            $admins = $this->getUsersWithRole('admin');
            $admins[] = $this->getCreator();
            return $admins;
        }
        
        public function getModerators(){
            return $this->getUsersWithRole('moderator');
        }

        public function getReaders(){
            return $this->getUsersWithRole('reader');
        }
        
        private function getUsersWithRole($roleName){
            $users = array();
            $userIds = BlogRole::join('roles', 'roles.id', '=', 'blog_roles.role_id')
                    ->where('blog_roles.blog_id', $this->id)
                    ->where('roles.name', $roleName)
                    ->lists('blog_roles.user_id');
            if(count($userIds)>0)
                $users = User::whereIn('id', $userIds)->get();
            return $users;
        }
        
        public function isAdmin($userId){
            $adminRoleId = Role::whereName('admin')->first()->id;
            return $this->checkRole($userId, $adminRoleId);
        }
        
        public function isModerator($userId) {
            $moderatorRoleId = Role::whereName('moderator')->first()->id;
            return $this->checkRole($userId, $moderatorRoleId);
        }

        public function isReader($userId) {
            $readerRoleId = Role::whereName('reader')->first()->id;
            return $this->checkRole($userId, $readerRoleId);
        }
        
        public function isBanned($userId){
            $bannedRoleId = Role::whereName('banned')->first()->id;
            return $this->checkRole($userId, $bannedRoleId);
        }

        public function vote($iValue) {
            /**
             * Устанавливаем рейтинг блога, используя логарифмическое распределение
             */
            $skill = Auth::user()->skill;
            $iMinSize = 1.13;
            $iMaxSize = 15;
            $iSizeRange = $iMaxSize - $iMinSize;
            $iMinCount = log(0 + 1);
            $iMaxCount = log(500 + 1);
            $iCountRange = $iMaxCount - $iMinCount;
            if ($iCountRange == 0) {
                $iCountRange = 1;
            }
            if ($skill > 50 and $skill < 200) {
                $skill_new = $skill / 20;
            } elseif ($skill >= 200) {
                $skill_new = $skill / 10;
            } else {
                $skill_new = $skill / 50;
            }
            $iDelta = $iMinSize + (log($skill_new + 1) - $iMinCount) * ($iSizeRange / $iCountRange);
            /**
             * Сохраняем рейтинг
             */
            $iNewRating = round($iValue * $iDelta, 3);
            $this->rating += $iNewRating;
            return $iNewRating;
        }

        public function getUserRole() {
            return BlogRole::join('roles', 'roles.id', '=', 'blog_roles.role_id')
                ->where('blog_roles.blog_id', $this->id)
                ->where('user_id', Auth::user()->id)
                ->pluck('name');
        }
        
        public function getUrl(){
            $url = '';
            if($this->type->name == 'personal'){
                $url = URL::to('profile').'/'.$this->author->email.'/created/topics';
            } else {
                $url = URL::to('blog').'/show/'.$this->id;
            }
            return $url;
        }

        public function getBlogUsers(){
            $userIds = BlogRole::join('roles', 'roles.id', '=', 'blog_roles.role_id')
                            ->where('blog_roles.blog_id', $this->id)
                            ->get(array('user_id'))->toArray();
            return User::whereIn('id', $userIds)->get();
        }
}
