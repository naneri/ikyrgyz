<script>
    var comment = {
            delete: function(commentId) {
                $.ajax({
                    method:"POST",
                    url:"",
                    success:function(){
                        
                    }
                });
            },
            addForm: function(commentId) {
                var $commentBody = $('#comment_body_' + commentId);
                if($commentBody.children('.comment_add_form').length){
                    comment.removeForm();
                } else {
                    comment.removeForm();
                    var replyForm = '<div class="comment_add_form"><textarea class="comment_text" /><br><button type="button" class="btn btn-primary" onclick="comment.submit('+commentId+');">Добавить</button></div>';
                    $commentBody.append(replyForm);
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
                            $('#comments_reply_'+commentId).append($result.comment);
                        }
                    }
                });
            }
        };
</script>