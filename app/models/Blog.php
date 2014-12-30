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
            return DB::table('users')
                    ->join('blog_role', 'users.id', '=', 'blog_role.user_id')
                    ->join('roles', 'roles.id', '=', 'blog_role.role_id')
                    ->where('blog_role.blog_id', $this->id)
                    ->get();                    
        }
        
        public function isHaveRelationWithUser(){
            return DB::table('blog_subscriptions')
                    /*->join('subscription_statuses', 'blog_subscriptions.status_id', '=', 'subscription_statuses.id')
                    ->where('')*/
                    ->where('user_id', Auth::user()->id)
                    ->where('blog_id', $this->id)
                    ->exists();
        }
        
        public function getUserStatus(){
            $status_id = BlogSubscription::where('blog_id', $this->id)->where('user_id', Auth::user()->id)->pluck('status_id');
            return SubscriptionStatus::whereId($status_id)->pluck('name');
        }
        
        public function getBlogSubscription(){
            return BlogSubscription::where('blog_id', $this->id)->where('user_id', Auth::user()->id)->get();
        }
}