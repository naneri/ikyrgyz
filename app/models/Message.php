<?php 

class Message extends Eloquent{
        use SoftDeletingTrait;

        protected $connection = 'mysql_users';
	
	public $timestamps = true;
        protected $softDelete = true;
                
        public function sender(){
		return $this->belongsTo('User', 'sender_id');
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
}