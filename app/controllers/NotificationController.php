<?php

class NotificationController extends BaseController{

    public function getAll(){

        $notes = NotificationRepository::getAllNotifications(Auth::id());

        return View::make('notification.list', compact('notes'));
        
    }

    public function markNotification()
    {
        
    }
}