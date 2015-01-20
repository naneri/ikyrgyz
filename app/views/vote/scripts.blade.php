<script>
    var vote = {
        topic: function(topicId, value) {
            $topicBox = $('#topic_' + topicId);
            $.ajax({
                method: "POST",
                url: "{{$base_config['base_url']}}/vote/topic",
                data: {
                    'topic_id': topicId,
                    'value': value
                },
                success: function($result) {
                    if (!$result['error'] && $result['rating']) {
                        $topicBox.find('.rating').html($result.rating);
                    }
                }
            });
        },
        comment: function(commentId, value){
            $commentBox = $('#comment_body_' + commentId);
            $.ajax({
                method: "POST",
                url: "{{$base_config['base_url']}}/vote/comment",
                data: {
                    'comment_id': commentId,
                    'value': value
                },
                success: function($result) {
                    if (!$result['error'] && $result['rating']) {
                        $commentBox.find('.rating').html($result.rating);
                    }
                }
            });
        },
        blog: function(blogId, value) {
            $blogBox = $('#blog_' + blogId);
            $.ajax({
                method: "POST",
                url: "{{$base_config['base_url']}}/vote/blog",
                data: {
                    'blog_id': blogId,
                    'value': value
                },
                success: function($result) {
                    if (!$result['error'] && $result['rating']) {
                        $blogBox.find('.rating').html($result.rating);
                    }
                }
            });
        },
        user: function(userId, value) {
            $userBox = $('#user_' + userId);
            $.ajax({
                method: "POST",
                url: "{{$base_config['base_url']}}/vote/user",
                data: {
                    'user_id': userId,
                    'value': value
                },
                success: function($result) {
                    if (!$result['error'] && $result['rating']) {
                        $userBox.find('.rating').html($result.rating);
                    }
                }
            });
        }
    }
</script>