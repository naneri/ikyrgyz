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
                var $topicBox = $('#topic_' + topicId);
                if($topicBox.find('#comments').length) {
                    comment.scroll(topicId);
                } else {
                    $.ajax({
                        method: "POST",
                        url: "{{$base_config['base_url']}}/topic/comments/show",
                        data: {
                            'topic_id': topicId
                        },
                        success: function($result) {
                            if (!$result['error'] && $result['comments']) {
                                var commentsBox = '<div class= "comments" id = "comments">' + $result.comments + '</div>';
                                $topicBox.append(commentsBox);
                                comment.scroll(topicId);
                            }
                        }
                    });
                }
            },
            scroll: function(topicId) {
                $('html, body').animate({
                    scrollTop: parseInt($('#topic_' + topicId).find('#comments').offset().top - 100)
                }, 1000);
            },
            vote: function(commentId, value){
                $commentBox = $('#comment_body_'+commentId);
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
            }
        };
</script>