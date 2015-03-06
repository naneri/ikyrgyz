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
                var $commentAddForm = $('#add_comment_form');
                var $commentBody = $('#topic_'+topicId+' #comment_body_' + commentId);
                var onClickSubmit = "comment.submit(" + commentId + "," + topicId + ");";
                $commentAddForm.find('#submit_btn').attr('onclick', onClickSubmit);
                $commentAddForm.find('div.b-profile-about-form').attr('id', '#add_comment_'+commentId);
                $commentAddForm.appendTo($commentBody);
                $('html, body').animate({
                    scrollTop: parseInt($commentAddForm.offset().top-100)
                }, 1000);
            },
            removeForm: function(){
                $('.comment_add_form').remove();
            },
            submit: function(commentId, topicId){
                var $commentBody = $('#add_comment_form');
                $.ajax({
                    method: "POST",
                    url: "{{$base_config['base_url']}}/topic/comment/add",
                    data: {
                        'text': $commentBody.find('#add_comment_text').val(),
                        'parent_id': commentId,
                        'topic_id': topicId
                    },
                    success: function($result) {
                        if(!$result['error'] && $result['comment']){
                            comment.removeForm();
                            $('#topic_' + topicId + ' #comments_child_' + commentId).append($result.comment);
                            comment.addForm(0, topicId);
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
        };
</script>