<?php

class MessageController extends BaseController{

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
     * 
	 * @return открывает вьюху
	 */
	public function show($id){

        // ищет сообщение по id включая удалённые сообщения
		$message = Message::withTrashed()->find($id);

        // выясняет равен ли получатель владельцу сообщения
		if($message->receiver_id == Auth::id()){

            // отмечает сообщение прочитанным
            $result = $message->setWatched();
        }
		return View::make('message.show', array('message' => $message));
	}
        
    /**
     * Открывает ящик пользователя
     * 
     * @param  [type] $filter [description]
     * @return [type]         [description]
     */
    public function inbox($filter = NULL){
        $messages = array();
        switch($filter){
            case 'friend':
                $messages = Auth::user()->messagesInbox;
                break;
            case 'group':
                break;
            case 'event':
                break;
            default:
                $messages = Message::inbox(Auth::user());                    
        }

        return View::make('message.inbox', array('messages' => $messages));
    }
        
    /**
     * [newMessage description]
     * @return [type] [description]
     */
    public function newMessage(){

        $receiver = Input::get('receiver');

        return View::make('message.new', array('receiver' => $receiver));

    }

    public function postNewMessage() {
        
        $validator = Validator::make(Input::all(), Message::$rules);
                    
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
        $names = explode(' ', trim(Input::get('receiver')));
        
        $receiver = User::join('user_description as ud', 'ud.user_id', '=', 'users.id')
                ->where('ud.first_name', 'like', $names[0])
                ->where('ud.last_name', 'like', (count($names)>1) ? $names[1] : '%')
                ->select('users.*')
                ->first();
                       
        if (!$receiver) {
            return Redirect::back()->withInput()->withErrors(array('receiver' => 'Пользователь не найден'));
        }
        if(!Auth::user()->canSendMessage($receiver->id)){
            return Redirect::back()->withInput()->withErrors(array('receiver' => 'Вы можете отправлять сообщения только друзьям'));
        }
        $message = null;
        if(Input::has('message_id')){
            $message = Message::find(Input::get('message_id'));
            if(!$message->canEdit()){
                $message = new Message;
            }
        }else{
            $message = new Message;
        }
        
        $message->sender_id = Auth::id();
        $message->receiver_id = $receiver->id;
        $message->title = Input::get('title');
        $message->text = Input::get('text');
        $message->from = 'friend';
        $message->draft = Input::get('is_draft');
        $message->save();
        
        if(Input::hasFile('attachments')){
            $this->saveMessageAttachments($message->id);
        }
        return Redirect::to('message/show/'.$message->id);
    }

    public function sendMessageDraft($id) {
        $message = Message::find($id);
        
        if($message->draft != 1 || $message->sender_id != Auth::id()){
            return Redirect::back()->withErrors(array('message', 'Вы не можете отправить данное сообщение'));
        }
        
        $message->draft = 0;
        $message->save();

        return Redirect::back()->with('message', '<div class="b-message b-message-success"><a href="javascript: $(`.b-message`).remove()" class="b-message-close"></a><div class="b-message-icon b-message-success-icon"></div><p class="b-message-p">Сообщение успешно отправлена</p></div>');
    }

    public function outbox(){
        return View::make('message.outbox');
    }

    public function trash(){
        return View::make('message.trash');
    }

    public function contacts() {
        return View::make('message.contacts');
    }

    public function draft() {
        return View::make('message.draft');
    }

    public function blacklist() {
        return View::make('message.blacklist');
    }
    
    public function postBlacklist() {
        $result = array();
        $rules = array(
            'user_id' => 'required|exists:users,id'
            );

        $validator = Validator::make(Input::all(), $rules);

        $verifier = App::make('validation.presence');
        $verifier->setConnection('mysql_users');
        $validator->setPresenceVerifier($verifier);

        if ($validator->fails()) {
            $result['error'] = $validator->messages();
            return Response::json($result);
        }
        
        if(!in_array(Input::get('action'), array('out', 'in'))){
            $result['error'] = 'error action';
            return Response::json($result);
        }
        
        Friend::fromBan(Input::get('user_id'));
        
        $result['users'] = View::make('message.build.users', array('users' => Auth::user()->bannedUsers()))->render();
        return Response::json($result);
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
        if(!in_array(Input::get('action'), array('set_watch', 'set_notwatch', 'blacklist', 'delete', 'restore', 'force_delete'))){
            $result['error'] = 'error action!';
            return Response::json($result);
        }
        $messageIds = Input::get('messages');
        $action = Input::get('action');
        if($action == 'set_watch'){
            Message::whereIn('id', $messageIds)->update(['watched' => '1']);
        }elseif($action == 'set_notwatch'){
            Message::whereIn('id', $messageIds)->update(['watched' => '0']);
        }elseif($action == 'blacklist'){
            foreach(Message::whereIn('id', $messageIds)->get() as $message){
                Friend::toBan($message->sender_id);
            }
        }elseif($action == 'delete'){
            Message::whereIn('id', $messageIds)->delete();
        }elseif($action == 'restore'){
            Message::whereIn('id', $messageIds)->restore();
        }elseif($action == 'force_delete'){
            Message::withTrashed()->whereIn('id', $messageIds)->forceDelete();
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
                $renderMessages = Auth::user()->messagesTrashed();
                break;
        }
        
        $result['messages'] = View::make('message.build.messages', array('messages' => $renderMessages))->render();            
        return Response::json($result);
    }
    
    public function deleteMessage($id){
        $message = Message::find($id);
        $message->delete();
        return Redirect::to('messages/trash');
    }

    public function editMessage($id) {
        $message = Message::find($id);
        return View::make('message.edit', array('message' => $message));
    }
}