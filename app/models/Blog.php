<?php

Class Blog extends Eloquent{

        public static $rules = array(
            'title' => 'required', 
            'description' => 'required',
            'type_id' => 'required'
        );
        
        protected $fillable = ['title', 'description', 'type_id'];
        
        public function type(){
            return $this->belongsTo('BlogType');
        }
        
        public function topics()
        {
            return $this->hasMany('Topic');
        }
        
        public function isAdminCurrentUser(){
            $admin_role = Role::whereName('admin')->first()->id;
            $userId = Auth::user()->id;
            return $this->checkRole($userId, $admin_role);
        }
        
        public function isModeratorCurrentUser(){
            $moderator_role = Role::whereName('moderator')->first()->id;
            $userId = Auth::user()->id;
            return $this->checkRole($userId, $moderator_role) || $this->isAdmin($userId);
        }
        
        private function checkRole($userId, $roleId){
            return DB::table('blog_role')
                ->where('role_id', $roleId)
                ->where('blog_id', $this->id)
                ->where('user_id', $userId)
                ->exists();
        }
        
        public function getBlogUsers(){
            return User::join('blog_role', 'users.id', '=', 'blog_role.user_id')
                    ->join('roles', 'roles.id', '=', 'blog_role.role_id')
                    ->where('blog_role.blog_id', $this->id)
                    ->select('users.*')
                    ->get();                    
        }
        
        public function isUserHaveRole(){
            return BlogRole::where('blog_role.blog_id', $this->id)
                    ->where('user_id', Auth::user()->id)
                    ->exists();
        }
        
        public function getUserRole(){
            return BlogRole::join('roles', 'roles.id', '=', 'blog_role.role_id')
                    ->where('blog_role.blog_id', $this->id)
                    ->where('user_id', Auth::user()->id)
                    ->pluck('name');
        }
        
        public function getAdmins(){
            return $this->getUsersWithRole('admin');
        }
        
        public function getModerators(){
            return $this->getUsersWithRole('moderator');
        }

        public function getReaders(){
            return $this->getUsersWithRole('reader');
        }
        
        private function getUsersWithRole($roleName){
            if(Role::whereName($roleName)->exists()){
                return User::join('blog_role', 'users.id', '=', 'blog_role.user_id')
                            ->join('roles', 'roles.id', '=', 'blog_role.role_id')
                            ->where('blog_role.blog_id', $this->id)
                            ->where('roles.name', $roleName)
                            ->get();
            }
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

}