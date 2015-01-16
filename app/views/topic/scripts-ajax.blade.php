<script>
    var topic = {
        vote: function(topicId, value) {
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
        }
    }
</script>