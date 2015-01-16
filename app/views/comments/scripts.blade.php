<script>
    var comment = {
            delete: function(commentId) {
                var $commentBody = $('#comment_body_' + commentId);
                $.ajax({
                    method:"POST",
                    url:"{{$base_config['base_url']}}/topic/comment/delete",
                    data: {
                        'comment_id': commentId
                    },
                    success:function($result){
                        if(!$result['error'] && $result['comment']){
                            $commentBody.html($result.comment);
                        }
                    }
                });
            },
            addForm: function(commentId, topicId) {
                var $commentBody = $('#topic_'+topicId+' #comment_body_' + commentId);
                if($commentBody.children('.comment_add_form').length){
                    comment.removeForm();
                } else {
                    comment.removeForm();
                    var form = '<div class="comment_add_form" id="add_comment_'+commentId+'">'+
                                    '<input type="hidden" class="topic_id" value="'+topicId+'">'+
                                    '<textarea class="comment_text" /><br>'+
                                    '<button type="button" class="btn btn-primary" onclick="comment.submit('+commentId+','+topicId+');">Добавить</button></div>';
                    $commentBody.append(form);
                    $('html, body').animate({
                        scrollTop: parseInt($("#topic_" + topicId + " #add_comment_"+commentId).offset().top-100)
                    }, 1000);
                }
            },
            removeForm: function(){
                $('.comment_add_form').remove();
            },
            submit: function(commentId, topicId){
                var $commentBody = $('#topic_'+topicId+' #comment_body_' + commentId);
                $.ajax({
                    method: "POST",
                    url: "{{$base_config['base_url']}}/topic/comment/add",
                    data: {
                        'text': $commentBody.find('.comment_text').val(),
                        'parent_id': commentId,
                        'topic_id': $commentBody.find('.topic_id').val()
                    },
                    success: function($result) {
                        if(!$result['error'] && $result['comment']){
                            comment.removeForm();
                            $('#topic_' + topicId + ' #comments_child_' + commentId).append($result.comment);
                        }
                    }
                });
            },
            response: function(parentId, commentHtml){
                var $commentContainer = null;
                $commentContainer = $('#comments_child_' + parentId);
                $commentContainer.append(commentHtml);
            },
            restore: function(commentId){
                var $commentBody = $('#comment_body_' + commentId);
                $.ajax({
                    method: "POST",
                    url: "{{$base_config['base_url']}}/topic/comment/restore",
                    data: {
                        'comment_id': commentId
                    },
                    success: function($result) {
                        if (!$result['error'] && $result['comment']) {
                            $commentBody.html($result.comment);
                        }
                    }
                });
            },
            show: function(topicId){
                var $commentsBox = $('#topic_comments_' + topicId);
                $.ajax({
                    method: "POST",
                    url: "{{$base_config['base_url']}}/topic/comments/show",
                    data: {
                        'topic_id': topicId
                    },
                    success: function($result) {
                        if (!$result['error'] && $result['comments']) {
                            $commentsBox.html($result.comments);
                            $('html, body').animate({
                                scrollTop: parseInt($("#topic_comments_" + topicId).offset().top - 100)
                            }, 1000);
                        }
                    }
                });
            }
        };
</script>