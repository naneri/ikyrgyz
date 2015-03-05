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

        static function setWatched($id){
		$message = Message::find($id);
		if($message->watched === 0){
			$message->watched = 1;
			$message->save();
		} 
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