<?php

class BlogSubscription extends \Eloquent {
	protected $fillable = ['status_id'];
        
        public function statuses(){
            $this->belongsTo('SubscriptionStatus');
        }
}