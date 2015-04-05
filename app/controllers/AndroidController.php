<?php

class AndroidController extends BaseController {
    public function __construct(){
        parent::__construct();
        var_dump(Session::get('android_authorized', 0)); die;
        if (Session::get('android_authorized', 0)) {
            return;
            $returnData = array();
            $user_data = User::with('description')->find(Auth::id());
            if (!empty($user_data)) {
                // Отправляет в шаблон все запросы о добавлении в друзья
                $returnData['friend_requests'] = Friend::getFriendRequests(Auth::id());

                // Отправляет в шаблон все новые сообщения
                $returnData['new_messages'] = Message::where('receiver_id', '=', Auth::id())->where('watched', '=', 0)->join('users', 'messages.sender_id', '=', 'users.id')->join('user_description', 'messages.sender_id', '=', 'user_description.user_id')->select('messages.*', 'user_description.*')->get();

                // Отправляет в шаблон данные о пользователе
                $returnData['user_data'] = $user_data;
//                return Response::json($returnData, 200);
            }
        }
        header("HTTP/1.0 405 Method Not Allowed");
        exit();
    }

    public function androidIndex(){
        $rating = Config::get('topic.index_good_topic_rating');
        $topics = Topic::getSubscribedTopics(Auth::user()->id, $rating);
        return Response::json($topics, 200);
    }

    public function androidAjaxTopics($sort, $page = 0){
        $rating = Config::get('topic.index_good_topic_rating');
        $offset = $page; // с какого начинать просмотр
        switch ($sort){
            case 'good':
                $topics = Topic::getSubscribedTopics(Auth::user()->id, $rating, $offset);
                break;
            case 'new':
                $topics = Topic::getTopicsByDate($offset);
                break;
            case 'top':
                $topics = Topic::getTopicsByRating($offset);
                break;
            default:
                $topics = Topic::getSubscribedTopics(Auth::user()->id, $rating, $offset);
        }
        return Response::json($topics, 200);
    }

    public function androidNewTopics(){
        $topics = Topic::getTopicsByDate();
        return Response::json($topics, 200);
    }

    public function androidTopTopics() {
        $topics = Topic::getTopicsByRating();
        return Response::json($topics, 200);
    }
}
