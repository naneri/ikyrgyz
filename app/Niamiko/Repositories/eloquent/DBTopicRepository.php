<?php

namespace Niamiko\Repositories;

use Niamiko\Repositories\TopicRepositoryInterface;
use Topic;
use Auth;

class DbTopicRepository implements TopicRepositoryInterface{

	public function check(){
		echo "<pre>"; print_r('check passed'); echo "</pre>";exit;
	}

	public function create($blog_id){
		$topic = new Topic;
		$topic->type_id = 1;
        $topic->user_id = Auth::user()->id;
        $topic->blog_id = $blog_id;
        $topic->save();
        return $topic;
	}
}