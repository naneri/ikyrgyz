<?php


class Notification extends \Eloquent 
{

    protected $fillable = ['body', 'type_id', 'reciever_id', 'notified'];
    protected $connection = 'mysql_users';

    public function type() {

        return $this->belongsTo('NotificationType');

    }
    /**
     * checks if same notification which user has not 
     * been notified about exists and in that case does not create a new one. 
     * If such a notifcation does not exist - then creates it.
     * 
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    public static function checkOrCreate($message_body, $reciever_id){

        $params = array(
            'notified'  => 0,
            'body'      => serialize($message_body),
            'user_id'   => $reciever_id
            );

        if(self::where($params)->first() == ''){

            self::create($params);

        }
    }

    /**
     * Gets last notifications of which the user was not notified
     * @param  [type]
     * @return [type]
     */
    public static function getLast($user_id){

        $notifications =  Notification::where('user_id', $user_id)
                            ->where('notified', 0)
                            ->distinct()
                            ->orderBy('id', 'DESC')
                            ->lists('body');

        return self::deserealizer($notifications);

    }

    public static function getUserNotifications($user_id){

        $notifications = Notification::where('user_id', $user_id)
                            ->distinct()
                            ->orderBy('id', 'DESC')
                            ->get();

        return self::objectDeserealizer($notifications);     

    }


    public static function deserealizer($notification_array){

        foreach($notification_array as &$note){
            $note_arr = unserialize($note);
            $note     = Lang::get($note_arr['message'], $note_arr['params']);
        }

        return $notification_array;
    }

    public static function objectDeserealizer($notification_array){

        foreach($notification_array as &$note){
            $note_arr = unserialize($note->body);
            $note->body = Lang::get($note_arr['message'], $note_arr['params']);
        }

        return $notification_array;
    }

    public static function markAllRead($user_id){

        DB::table('notifications')->where([
                'user_id'   => $user_id,
                'notified'  => 0
            ])->update([
                'notified' => 1
            ]);
    }

}