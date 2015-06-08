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

    static function newFriend($sender_id, $reciever_id){

        $params = ['sender_name' => User::getFullNameById($sender_id)];

        $type_id = NotificationType::where('name', 'newfriend')->first()->id;

        Notification::create([  
            'body'      => serialize($params),
            'reciever_id' => $reciever_id,
            'type_id'   => $type_id,
            'notified'  => null
            ]);
    }   

    static function newTopicComment($reciever_id, $topic_id, $topic_title){
        $params = [
            'topic_id' => $topic_id,
            'topic_title'  => $topic_title
        ];

        $type_id = NotificationType::where('name', 'topicComment')->first()->id;
        Notification::create([
            'body'          => serialize($params),
            'reciever_id'   => $reciever_id,
            'type_id'       => $type_id,
            'notified'      => null,
            'link'          => route('showTopic', $topic_id)
            ]);
    }

    public function topicRemoved(){

    }

    public function blogNewTopic(){

    }

    public function deletedFromFriends(){

    }

    static function getAllByType(){

        return Notification::
                 select('notification_types.*', DB::raw('count(*) as total'))
                 ->join('notification_types', 'notifications.type_id', '=', 'notification_types.id')
                 ->where('reciever_id', Auth::id())
                 ->groupBy('type_id')
                 ->get();

    }

    public function getAllMessages(){

    }

    static function getAllNotifications($user_id){

        return Notification::with('type')
                 ->where('reciever_id', $user_id)
                 ->where('notified', null)
                 ->groupBy('body')
                 ->get(); 
    }
}