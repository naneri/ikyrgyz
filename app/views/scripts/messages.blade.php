<script>
    $(document).ready(function() {
        $('select[name="action"]').change(function() {
            if ($('input[name="messages[]"]:checked').length && confirm(trans('network.sure-perform-action'))) {
                var $form = $('form[name="messages"]');
                var data = $form.serialize();
                $.ajax({
                    method: 'POST',
                    url: $form.attr('action'),
                    data: data,
                    success: function($result) {
                        if (!$result.error) {
                            $('#messages').html($result.messages);
                            $('input[name="check-all"]').prop('checked', false);
                        }
                    },
                    error: function() {
                        console.log('error');
                    }
                });
            }
        });
        
        window.page = 'inbox';
        $('.b-message-ls-list__list a').click(function(e){
            e.preventDefault();
            var page = $(this).attr('data-page');
            message.update(page);
        });
        
    });
    var message = {
        toggleActionList: function(){
            $('.b-message-ls-mark-button-list.dropdown-list').toggle();
        },
        setAction: function(actionName, element){
            window.msgAction = actionName;
            $('.b-message-ls-mark-button-list.dropdown-list').toggle();
            var action = $(element).text();
            $('.b-message-ls-mark-button__item.button-select').html(action);
        },
        doAction: function(){
            if ($('input[name="messages[]"]:checked').length && window.msgAction) {
                var $form = $('form[name="messages"]');
                var data = $form.serialize();
                data += '&action='+window.msgAction;
                data += '&page='+window.page;
                $.ajax({
                    method: 'POST',
                    url: $form.attr('action'),
                    data: data,
                    success: function($result) {
                        if ($result.status != 'error') {
                            $('#messages').html($result.content);
                            $('input[name="check-all"]').prop('checked', false);
                        }
                        $.notify($result.message, $result.status);
                    },
                    error: function() {
                        console.log('error');
                    }
                });
            }
        },
        update: function(page){
            var url = '{{URL::to("messages")}}'+'/'+page;
            $.get(url, function($result) {
                $('#messages').html($result);
                window.msgAction = '';
                window.page = page;
            });
        },
        checkAll: function(element){
            if (element.checked) {
                $('input[name="messages[]"]').each(function() {
                    $(this).prop('checked', true);
                });
            } else {
                $('input[name="messages[]"]').each(function() {
                    $(this).prop('checked', false);
                });
            }
        },
        show: function(messageId){
            message.update('show/'+messageId);
        }
    }
</script>