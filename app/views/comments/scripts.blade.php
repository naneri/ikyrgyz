<script>
    var comment = {
            delete: function(commentId) {
                var $commentBody = $('#comment_body_' + commentId);
                $.ajax({
                    method:"POST",
                    url:"/topic/comment/delete",
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
            addForm: function(commentId) {
                var $commentBody = $('#comment_body_' + commentId);
                if($commentBody.children('.comment_add_form').length){
                    comment.removeForm();
                } else {
                    comment.removeForm();
                    var form = '<div class="comment_add_form"><textarea class="comment_text" /><br><button type="button" class="btn btn-primary" onclick="comment.submit('+commentId+');">Добавить</button></div>';
                    $commentBody.append(form);
                }
            },
            removeForm: function(){
                $('.comment_add_form').remove();
            },
            submit: function(commentId){
                var $commentBody = $('#comment_body_' + commentId);
                $.ajax({
                    method: "POST",
                    url: "/topic/comment/add",
                    data: {
                        'text': $commentBody.find('.comment_text').val(),
                        'parent_id': commentId,
                        'topic_id': $('#topic_id').val()
                    },
                    success: function($result) {
                        if(!$result['error'] && $result['comment']){
                            comment.removeForm();
                            $('#comments_child_' + commentId).append($result.comment);
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
                    url: "/topic/comment/restore",
                    data: {
                        'comment_id': commentId
                    },
                    success: function($result) {
                        if (!$result['error'] && $result['comment']) {
                            $commentBody.html($result.comment);
                        }
                    }
                });
            }
        };
</script>