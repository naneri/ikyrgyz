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
		$message = Message::where('messages.id', '=', $id)->join('users', 'messages.sender_id', '=', 'users.id')->get();
		Message::setWatched($id);
		return View::make('message.show', array('message' => $message[0]));
	}
        
        public function inbox(){
            $messages = '';//Message::where('receiver_id', '=', Auth::id())->join('users', 'messages.sender_id', '=', 'users.id')->join('user_description', 'user_description.user_id', '=', 'users.id')->paginate(5);
            return View::make('message.inbox', array('messages' => $messages));
        }
        
        public function newMessage(){
            return View::make('message.new');
        }

        public function postNewMessage() {
            $rules = array(
                'title' => 'required|alpha_num',
                'text' => 'required|string',
                'is_draft' => 'required');
            if(!boolval(Input::get('is_draft'))){
                $rules['receiver'] = 'required|email|exists:users,email';
            }
            
            $validator = Validator::make(Input::all(), $rules);
            
            $verifier = App::make('validation.presence');
            $verifier->setConnection('mysql_users');
            $validator->setPresenceVerifier($verifier);
            
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            
            $id = (boolval(Input::get('is_draft')))?Auth::id():User::whereEmail(Input::get('receiver'))->first()->id;
            
            $message = new Message;
            $message->sender_id = Auth::id();
            $message->receiver_id = $id;
            $message->title = Input::get('title');
            $message->text = Input::get('text');
            $message->from = 'user';
            $message->draft = Input::get('is_draft');
            $message->save();
            
            if(Input::hasFile('attachments')){
                $this->saveMessageAttachments($message->id);
            }
            return View::make('message.new');
        }
        
        public function outbox(){
            return View::make('message.outbox');
        }

        public function trash(){
            return View::make('message.trash');
        }

        public function draft() {
            return View::make('message.draft');
        }

        private function saveMessageAttachments($messageId) {
            $files = Input::file('attachments');
            $destinationPath = 'uploads/user/' . Auth::id();
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath);
            }
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . rand(1, 100) . '.' . $extension;
                $file->move($destinationPath, $fileName);
                $filePath = URL::to('/') . '/' . $destinationPath . '/' . $fileName;
                
                $messageAttachment = new MessageAttachment();
                $messageAttachment->message_id = $messageId;
                $messageAttachment->path = $filePath;
                $messageAttachment->name = $file->getClientOriginalName();
                //$messageAttachment->type = $file->getMimeType();
                $messageAttachment->save();
            }
        }
        
        public function postAction(){
            if(!in_array(Input::get('action'), array('set_watch', 'set_notwatch', 'blacklist', 'delete', 'restore'))){
                $result['error'] = 'error action!';
                return Response::json($result);
            }
            $messageIds = Input::get('messages');
            $action = Input::get('action');
            if($action == 'set_watch'){
                Message::whereIn('id', $messageIds)->update(['watched' => '1']);
            }elseif($action == 'set_notwatch'){
                Message::whereIn('id', $messageIds)->update(['watched' => '0']);
            }elseif($action == 'blaclist'){
                
            }elseif($action == 'delete'){
                Message::whereIn('id', $messageIds)->delete();
            }elseif($action == 'restore'){
                Message::whereIn('id', $messageIds)->restore();
            }
            
            $renderMessages = null;
            switch(Input::get('page')){
                case 'inbox':
                    $renderMessages = Auth::user()->messagesInbox;
                    break;
                case 'outbox':
                    $renderMessages = Auth::user()->messagesOutbox;
                    break;
                case 'draft':
                    $renderMessages = Auth::user()->messagesDraft;
                    break;
                case 'trash':
                    $renderMessages = Auth::user()->messagesTrashed;
                    break;
            }
            
            $result['messages'] = View::make('message.build.messages', array('messages' => $renderMessages))->render();            
            return Response::json($result);
        }

}