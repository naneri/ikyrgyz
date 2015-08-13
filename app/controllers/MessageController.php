<?php

class MessageController extends BaseController{

	/**
	 * Достаёт последние 5 сообщений
	 * 
	 * @return [type] [description]
	 */
	public function getAll(){
		$messages = Message::where('receiver_id', '=', Auth::id())->join('users', 'messages.sender_id', '=', 'users.id')->paginate(5);
		return $this->makeView('message.all', array('messages' => $messages));
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
		return $this->makeView('message.show', array('message' => $message));
	}
        
    /**
     * Открывает ящик пользователя
     * 
     * @param  [type] $filter [description]
     * @return [type]         [description]
     */
    public function inbox($filter = 'all'){
        $messages = array();

        if($filter == 'friend')
        {
            $messages = Auth::user()->messagesInbox()->orderBy('id', 'DESC')->paginate(20);
        }
        elseif(!in_array($filter, ['group', 'group', 'all']))
        {
            $messages = Auth::user()->messagesInbox()->orderBy('id', 'DESC')->paginate(20);
        }

        return $this->makeView('message.inbox', array('messages' => $messages));
    }
        
    /**
     * [newMessage description]
     * @return [type] [description]
     */
    public function newMessage(){

        $receiver = Input::get('receiver');

        return $this->makeView('message.new', array('receiver' => $receiver));

    }

    public function postNewMessage() {
        
        $validator = Validator::make(Input::all(), Message::$rules);
                    
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $receivers = Input::get('receivers');

        if (is_array($receivers) && count($receivers) > 0) {
            // первый цикл для проверки нет ли среди получателей "не-друзей"

            foreach ($receivers as $r) {
                $receiver = User::where('users.email', $r)->first();

                if (!$receiver) {
                    return Redirect::back()->withInput()->withErrors(array('receiver' => 'Получатель не найден'));
                }
                if(!Auth::user()->canSendMessage($receiver->id)){
                    return Redirect::back()->withInput()->withErrors(array('receiver' => 'Вы можете отправлять сообщения только друзьям'));
                }
            }

            // второй цикл уже для отправки по прежнему коду, только в цикле
            foreach ($receivers as $r) {
                $receiver = User::where('users.email', $r)->first();

                $message = null;
                if(Input::has('message_id')){
                    $message = Message::find(Input::get('message_id'));
                    if(!$message->canEdit()){
                        $message = new Message;
                    }
                }else{
                    $message = new Message;
                }

                $message->sender_id     = Auth::id();
                $message->receiver_id   = $receiver->id;
                $message->title         = Input::get('title');
                $message->text          = Input::get('text');
                $message->from          = 'friend';
                $message->draft         = Input::get('is_draft');
                $message->save();

                if(Input::hasFile('attachments')){
                    $this->saveMessageAttachments($message->id);
                }
            }
        } else {
            return Redirect::back()->withInput()->withErrors(array('receiver' => 'Укажите как минимум одного получателя'));
        }




        return Redirect::to('profile/messages?page=outbox')->with('message', [
            'type' => 'success',
            'text' => 'Сообщение отправлено'
        ]);
    }

    /**
     * [sendMessageDraft description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function sendMessageDraft($id) {
        
        $message = Message::find($id);
        
        if($message->draft != 1 || $message->sender_id != Auth::id()){
            return Redirect::back()->withErrors(array('message', 'Вы не можете отправить данное сообщение'));
        }
        
        $message->draft = 0;
        $message->save();

        return Redirect::back()->with('message', [
            'type' => 'success',
            'text' => 'Сообщение успешно отправлена'
            ]);
    }

    /**
     * [outbox description]
     * @return [type] [description]
     */
    public function outbox(){

        $messages = Auth::user()->messagesOutbox()->orderBy('id', 'DESC')->paginate(20);

        return $this->makeView('message.outbox', compact('messages'));

    }

    /**
     * [trash description]
     * @return [type] [description]
     */
    public function trash(){

        $messages = Auth::user()->messagesTrashed()->orderBy('id', 'DESC')->paginate(20);

        return $this->makeView('message.trash', compact('messages'));

    }

    /**
     * [contacts description]
     * @return [type] [description]
     */
    public function contacts() {

        return $this->makeView('message.contacts');

    }

    /**
     * [draft description]
     * @return [type] [description]
     */
    public function draft() {

        return $this->makeView('message.draft');

    }

    /**
     * [blacklist description]
     * @return [type] [description]
     */
    public function blacklist() {
        $bannedUsers = Auth::user()->bannedUsers();
        return $this->makeView('message.blacklist', compact('bannedUsers'));
    }
    
    /**
     * [postBlacklist description]
     * @return [type] [description]
     */
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
        
        $result['users'] = $this->makeView('message.build.users', array('users' => Auth::user()->bannedUsers()))->render();
        return Response::json($result);
    }

    /**
     * [saveMessageAttachments description]
     * @param  [type] $messageId [description]
     * @return [type]            [description]
     */
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
            
            $messageAttachment              = new MessageAttachment();
            $messageAttachment->message_id  = $messageId;
            $messageAttachment->path        = $filePath;
            $messageAttachment->name        = $file->getClientOriginalName();
            //$messageAttachment->type = $file->getMimeType();
            $messageAttachment->save();
        }
    }
    
    /**
     * [postAction description]
     * @return [type] [description]
     */
    public function postAction(){
        if(!in_array(Input::get('action'), array('set_watch', 'set_notwatch', 'blacklist', 'delete', 'restore', 'force_delete', 'unblack'))){
            $result['message'] = 'Ошибка действия';
            $result['status'] = 'error';
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
        }elseif($action == 'unblack') {
            foreach (Message::whereIn('id', $messageIds)->get() as $message) {
                Friend::fromBan($message->sender_id);
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
                $messages = Auth::user()->messagesInbox()->orderBy('id', 'DESC')->paginate(20);
                $result['content'] = $this->makeView('message.inbox', compact('messages'))->render();
                break;
            case 'outbox':
                $messages = Auth::user()->messagesOutbox()->orderBy('id', 'DESC')->paginate(20);
                $result['content'] = $this->makeView('message.outbox', compact('messages'))->render();
                break;
            case 'draft':
                $messages = Auth::user()->messagesDraft()->orderBy('id', 'DESC')->paginate(20);
                $result['content'] = $this->makeView('message.blacklist', compact('messages'))->render();
                break;
            case 'trash':
                $messages = Auth::user()->messagesTrashed()->orderBy('id', 'DESC')->paginate(20);
                $result['content'] = $this->makeView('message.trash', compact('messages'))->render();
                break;
            case 'blacklist':
                $bannedUsers = Auth::user()->bannedUsers();
                $result['content'] = $this->makeView('message.blacklist', compact('bannedUsers'))->render();
                break;
        }
        
        //$result['content'] = $this->makeView('message.build.messages', array('messages' => $renderMessages))->render();
        $result['message'] = 'Действие успешно выполнено';
        $result['status'] = 'success';
        return Response::json($result);
    }
    
    /**
     * [deleteMessage description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteMessage($id){

        $message = Message::find($id);

        $message->delete();

        return Redirect::to('messages/trash');

    }

    /**
     * [editMessage description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function editMessage($id) {

        $message = Message::find($id);

        return $this->makeView('message.edit', array('message' => $message));

    }
}