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
        topic: function(topicId, value) {
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
        }
    }
</script>
@endif