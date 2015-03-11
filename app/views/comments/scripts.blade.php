{{HTML::script('js/tinymce/tinymce.min.js')}}
<script>
$(document).ready(function(){
    comment.initEditor("textarea.add_comment_text");
});
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
                            $('#comments_child_' + commentId).append($result.comment);
                            comment.replyForm(commentId);
                            comment.initEditor('#comments_child_'+commentId+' textarea');
                            comment.scrollTo('#comment_' + $result.comment_id);
                        }
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
            replyForm: function(commentId){
                var formSelector = '#add_comment_'+commentId;
                var $replyForm = $(formSelector);
                if($replyForm.is(':visible')){
                    $replyForm.hide();
                } else {
                    $replyForm.show();
                    comment.scrollTo(formSelector);
                }
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