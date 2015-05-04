<?php 

class Message extends Eloquent{
    
    use SoftDeletingTrait;

    protected $connection = 'mysql_users';
	
    public static $rules = array(
            'receiver' => 'required',
            'title' => 'required|string',
            'text' => 'required|string',
            'is_draft' => 'required');


	public $timestamps = true;

    protected $softDelete = true;
            
    /** Relations **/ 
    
    public function sender(){
		return $this->belongsTo('User', 'sender_id');
	}

    public function receiver() {
        return $this->belongsTo('User', 'receiver_id');
    }

     public function attachments(){
        return $this->hasMany('MessageAttachment');
    }
    
    /** Relations **/
   



    /**
     * Отмечает сообщение как прочитанное
     */
    public function setWatched(){ 

        Debugbar::info('$this->watched = ' . $this->watched);
        
         if($this->watched == 0){
            $this->watched = 1;
            $this->save();

            Debugbar::info('попал в функцию Message.php - setWatched() - $this->watched === 0');
            
            return True;
         }
         return False;
    }
        
    public static function inbox(){
        return Message::where('receiver_id', Auth::id())->get();
    }
    
    public function scopeWithoutBanned($query){

        $bannedUserIds = Auth::user()->getBannedUserIds();
        
        return $query->whereNotIn('sender_id', $bannedUserIds);
    }
    
    public function canEdit(){
        return $this->sender_id == Auth::id() && $this->draft == 1;
    }


    public static function sendMessage($sender_id, $reciever_id, $text){

        return self::create([
            'sender_id'     => $sender_id,
            'receiver_id'   => $reciever_id,
            'text'          => $text
            ]);
        
    }
}