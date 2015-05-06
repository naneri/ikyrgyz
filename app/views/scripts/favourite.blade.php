@if(isset($base_config))
<script>
    var favouriteUrl = "{{$base_config['base_url']}}/favourite/";
    var favourite = {
        notify: function($result){
            if($result.status == 'success' && $result.action == 'add'){
                $favourite.addClass('favourite');
            }else if($result.status == 'success' && $result.action == 'remove') {
                $favourite.removeClass('favourite');
            }
            $.notify($result.message, $result.status);
        },
        topic: function(topicId) {
            $favourite = $('#favourite_topic_' + topicId);
            $.ajax({
                method: "POST",
                url: favouriteUrl+"topic",
                data: {
                    'topic_id': topicId
                },
                success: function($result) {
                    favourite.notify($result);
                }
            });
        },
        blog: function(blogId) {
            $favourite = $('#favourite_blog_' + blogId);
            $.ajax({
                method: "POST",
                url: favouriteUrl+"blog",
                data: {
                    'blog_id': blogId
                },
                success: function($result) {
                    favourite.notify($result);
                }
            });
        },
    }
</script>
<style>
    .b-profile-about-tags-user__right .btn.favourite{
        background: #FFCC79;
    }
</style>
@endif