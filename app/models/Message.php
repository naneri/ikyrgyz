<?php 

class Message extends Eloquent{
    
    use SoftDeletingTrait;

    protected $connection = 'mysql_users';
	
	public $timestamps = true;
        protected $softDelete = true;
                
        public function sender(){
		return $this->belongsTo('User', 'sender_id');
	}

    public function receiver() {
        return $this->belongsTo('User', 'receiver_id');
    }

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
    
    public function attachments(){
        return $this->hasMany('MessageAttachment');
    }
    
    public function canEdit(){
        return $this->sender_id == Auth::id() && $this->draft == 1;
    }
}