<?php 

class Message extends Eloquent{

	protected $connection = 'mysql_users';
	
	public $timestamps = true;

	public function sender(){
		$this->hasOne('User', 'id', 'sender_id');
	}

	static function setWatched($id){
		$message = Message::find($id);
		if($message->watched === 0){
			$message->watched = 1;
			$message->save();
		} 
	}
}