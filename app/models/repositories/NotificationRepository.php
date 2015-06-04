<?php

class NotificationRepository
{

    /*public function messageSent($sender_id, $reciever_id){
        
        $message_body = [
            'message'       => 'notifications.message-sent',
            'params'        => [
                'sender_name'   => User::findOrFail($sender_id)->username
            ]
        ];
        Notification::checkOrCreate($message_body, $reciever_id);

    }

    public function getAllNotifications($user_id){

        return Notification::getUserNotifications($user_id);

    }

    public function makeRead($user_id){

        return Notification::markAllRead($user_id);
    }

    public function createNotification($local_message, $params, $reciever_id){

        Notification::createNotification($local_message, $params, $reciever_id);

    }*/

    public function newFriend($sender_id, $reciever_id){

        $params = ['sender_name' => User::getFullNameById($sender_id)];

        $type_id = NotificationType::where('name', 'newfriend')->first()->id;

        Notification::create([  
            'body'      => serialize($params),
            'reciever_id' => $reciever_id,
            'type_id'   => $type_id,
            'notified'  => null
            ]);
    }   

    public function newComment(){

    }

    public function topicRemoved(){

    }

    public function blogNewTopic(){

    }

    public function deletedFromFriends(){

    }

    public function getAllByType(){

    }

}