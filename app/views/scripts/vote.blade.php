@if(isset($base_config))
{{HTML::script('js/notify.js')}}
<script>
    var voteUrl = "{{$base_config['base_url']}}/vote/";
    var vote = {
        notify: function($result){
            if (!$result['error'] && $result['rating']) {
                $rating.html($result.rating);
                $.notify($result.success, 'success');
            } else if($result.error) {
                $.notify($result.error, 'error');
            }            
        },
        topic: function(topicId, value, logged) {
            if(!logged){
                not_logged(logged);
                return;
            }
            $rating = $('#rating_topic_' + topicId);
            $.ajax({
                method: "POST",
                url: voteUrl+"topic",
                data: {
                    'topic_id': topicId,
                    'value': value
               
                },
                success: function($result) {
                    vote.notify($result);
                }
            });

        },
        comment: function(commentId, value){
            $rating = $('#rating_comment_' + commentId);
            $.ajax({
                method: "POST",
                url: voteUrl+"comment",
                data: {
                    'comment_id': commentId,
                    'value': value
                },
                success: function($result) {
                    vote.notify($result);
                }
            });
        },
        blog: function(blogId, value) {
            $rating = $('#rating_blog_' + blogId);
          
            $.ajax({
                method: "POST",
                url: voteUrl+"blog",
                data: {
                    'blog_id': blogId,
                    'value': value
                },
                success: function($result) {
                    vote.notify($result);
                }
            });
        },
        user: function(userId, value) {
            $rating = $('#rating_user_' + userId);
            $.ajax({
                method: "POST",
                url: voteUrl+"user",
                data: {
                    'user_id': userId,
                    'value': value
                },
                success: function($result) {
                    vote.notify($result);
                }
            });
        },
        photo: function(photoId, value){
            $rating = $('#rating_photo_' + photoId);
                $.ajax({
                    method: "POST",
                    url: voteUrl + "photo",
                    data: {
                        'photo_id': photoId,
                        'value': value
                    },
                    success: function($result) {
                        vote.notify($result);
                        if($result.success){
                            $('#photo_'+photoId).attr({'data-rating': $result.rating });
                        }
                    }
                });
        },
        audio: function(audioId, value){
            $rating = $('#rating_audio_' + audioId);
                $.ajax({
                    method: "POST",
                    url: voteUrl + "audio",
                    data: {
                        'audio_id': audioId,
                        'value': value
                    },
                    success: function($result) {
                        vote.notify($result);
                        if($result.success){
                            $rating.html($result.rating);
                        }
                    }
                });
        },
        audioalbum: function(audioAlbumId, value){
            $rating = $('#rating_audioalbum_' + audioAlbumId);
                $.ajax({
                    method: "POST",
                    url: voteUrl + "audioalbum",
                    data: {
                        'audio_album_id': audioAlbumId,
                        'value': value
                    },
                    success: function($result) {
                        vote.notify($result);
                        if($result.success){
                            $rating.html($result.rating);
                        }
                    }
                });
        },
    }
</script>
@endif