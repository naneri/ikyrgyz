<?php

class MessageController extends BaseController{

	/**
	 * Отправляет сообщение пользователю от авторизованного пользователя.
	 * 
	 * @param   $id Id пользователя которому отправляется сообщение
	 * 
	 * @return 
	 */
	public function sendMessage($id){
		$message = new Message;
		$message->sender_id = Auth::id();
		$message->receiver_id = $id;
		$message->text = Input::get('text');
		$message->save();

		return Redirect::back()->with('message','message sent successfully');
	}

	/**
	 * Достаёт последние 5 сообщений
	 * 
	 * @return [type] [description]
	 */
	public function getAll(){
		$messages = Message::where('receiver_id', '=', Auth::id())->join('users', 'messages.sender_id', '=', 'users.id')->paginate(5);
		return View::make('message.all', array('messages' => $messages));
	}

	/**
	 * Достаёт информацию по сообщению
	 * 
	 * @param  [type] $id id сообщения
	 * @return [type]     [description]
	 */
	public function show($id){
		$message = Message::find($id)->join('users', 'messages.sender_id', '=', 'users.id')->get();
		Message::setWatched($id);
		return View::make('message.show', array('message' => $message));
	}
}