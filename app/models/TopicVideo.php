<?php

class TopicVideo extends \Eloquent {
    
    protected $table = 'topic_video';
	protected $fillable = ['topic_id', 'url', 'embed_code'];
}