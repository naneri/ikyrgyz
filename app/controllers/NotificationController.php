<?php

class NotificationController extends BaseController{

    public function getAll(){

        $notes = NotificationRepository::getAllNotifications(Auth::id());

        return $this->makeView('notification.list', compact('notes'));
        
    }

    public function markNotification()
    {
        
    }
    
}