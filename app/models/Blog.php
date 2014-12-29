<?php

Class Blog extends Eloquent{

        public static $rules = array(
            'title' => 'required', 
            'description' => 'required',
            'blog_type_id' => 'required'
        );
        
        protected $fillable = ['title', 'description', 'blog_type_id'];
        
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
}