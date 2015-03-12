{{HTML::script('js/tinymce/tinymce.min.js')}}
<script>
    var comment = {
            submit: function(commentId, topicId){
                tinyMCE.triggerSave();
                var $commentBody = $('#add_comment_'+commentId);
                $.ajax({
                    method: "POST",
                    url: "{{$base_config['base_url']}}/topic/comment/add",
                    data: {
                        'text': $commentBody.find('.add_comment_text').val(),
                        'parent_id': commentId,
                        'topic_id': topicId
                    },
                    success: function($result) {
                        if(!$result.error && $result.comment){
                            var $commentsContainer = $('#comments_child_' + commentId);
                            if($('select[name="sort_by"').val() == 'new'){
                                $commentsContainer.prepend($result.comment);
                            }else{
                                $commentsContainer.append($result.comment);
                            }
                            $('#comments_child_' + commentId).append($result.comment);
                            comment.replyForm(commentId);
                            comment.initEditor('#comment_' + $result.comment_id + ' textarea');
                            comment.scrollTo('#comment_' + $result.comment_id);
                        }
                        comment.notify($result);
                    }
                });
            },
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
                        comment.notify($result);
                    }
                });
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
                        comment.notify($result);
                    }
                });
            },
            scroll: function(topicId) {
                $('html, body').animate({
                    scrollTop: parseInt($('#topic_' + topicId).find('#comments').offset().top - 100)
                }, 1000);
            },
            scrollTo: function(selector) {
                $('html, body').animate({
                    scrollTop: parseInt($(selector).offset().top - 100)
                }, 1000);
            },
            sort: function(topicId, sortBy){
                var $commentsBox = $('#comments_child_0');
                $.ajax({
                    method: "POST",
                    url: "{{$base_config['base_url']}}/topic/comments/sort",
                    data: {
                        'topic_id': topicId,
                        'sort_by': sortBy
                    },
                    success: function($result) {
                        if (!$result['error'] && $result['comments']) {
                            $commentsBox.html($result.comments);
                        }
                        comment.notify($result);
                    }
                });
            },
            show: function(commentId){
                $('#comment_'+commentId+'_text_show_msg').hide();
                $('#comment_'+commentId+'_text').show();
            },
            replyForm: function(commentId){
                if(commentId == 0){
                    return;
                }
                var formSelector = '#add_comment_'+commentId;
                var $replyForm = $(formSelector);
                if($replyForm.is(':visible')){
                    $replyForm.hide(300);
                } else {
                    $replyForm.show(300);
                    comment.scrollTo(formSelector);
                }
            },
            notify: function($result){
                $.notify($result.message, $result.status);
            },
            initEditor: function(selector){
                tinymce.init({
                    selector: selector,
                    language: 'ru',
                    menubar: false,
                    statusbar: false,
                    subfolder: "{{Auth::user()->id}}",
                    plugins: [
                        "autolink link image smileys filemanager media paste youtube"
                    ],
                    image_advtab: true,
                    relative_urls: false,
                    remove_script_host: true,
                    toolbar: "image youtube media smileys | publish",
                    setup: function(ed) {
                        /*ed.addButton('publish', {
                         text: 'Опубликовать',
                         icon: false,
                         onclick: function() {
                         // Add you own code to execute something on click
                         ed.focus();
                         ed.selection.setContent('Hello world!');
                         }
                         });*/
                    }
                });
            }
        };
</script>