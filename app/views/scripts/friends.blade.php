<script>
    var $friendsBlock = $('.b-content .b-friends');
    var friendUrl = "{{URL::to('/')}}/profile/friends";
    var friend = {
        setCategory: function(friendId, categoryName){
            $.ajax({
                method: "POST",
                url: friendUrl,
                data: {
                    'action': 'setCategory',
                    'friendId': friendId,
                    'categoryName': categoryName
                },
                success: function($result) {
                    friend.notify($result);
                }
            });
        },
        addCategory:function(categoryName){
            $.ajax({
                method: "POST",
                url: friendUrl,
                data: {
                    'action': 'addCategory',
                    'categoryName': categoryName
                },
                success: function($result) {
                    friend.notify($result);
                }
            });
        },
        editCategory:function(element){
            $(element).next().toggle();
        },
        remove: function(friendId){
            $.ajax({
                method: "POST",
                url: friendUrl,
                data: {
                    'action': 'removeFriend',
                    'friendId': friendId
                },
                success: function($result) {
                    friend.notify($result);
                }
            });
        },
        notify: function($result){
            if($result.content != ''){
                $('.b-content .b-friends').html($result.content);
            }
            $.notify($result.message, $result.status);
        },
        filter: function($category){
            var $block = $('.b-friends-sort__sort');
            $('.b-friends-inner__left .b-friends-block').each(function(){
                if($(this).attr('data-category') != $category && $category != 'Все'){
                    $(this).hide(400);
                }else{
                    $(this).show(400)
                }
            });
            $block.find('.dropdown-list').toggle();
            $block.find('.button-select').text($category);
        },
    }
</script>
<style>
</style>