@section('content')
{{HTML::style('css/bootstrap.css')}}
{{HTML::script('js/bootstrap.js')}}
<div class="b-content">
    <div class="col-md-4 messages-nav">
        <h4></h4>
        {{HTML::link('messages/new', trans('network.new-message'))}}
        {{HTML::link('messages/contacts', trans('network.contacts'))}}
        {{HTML::link('messages/inbox/all', trans('inbox'))}}
        {{HTML::link('messages/outbox', trans('outbox'))}}
        {{HTML::link('messages/draft', trans('drafts'))}}
        {{HTML::link('messages/blacklist', trans('blacklist'))}}
        {{HTML::link('messages/trash', trans('deleted'))}}
    </div>
    <div class="col-md-8">
        @yield('form')
    </div>
</div>
<style>
    .messages-nav {
        width: 25%;
        float: left;
    }
    .messages-nav a{
        display: block;
    }
</style>
<script>
    $('select[name="action"]').change(function(){
        if($('input[name="messages[]"]:checked').length && confirm(trans('network.sure-perform-action'))){
            var $form = $('form[name="messages"]');
            var data = $form.serialize();
            $.ajax({
                method: 'POST',
                url: $form.attr('action'),
                data: data,
                success: function($result){
                    if(!$result.error){
                        $('#messages').html($result.messages);
                        $('input[name="check-all"]').prop('checked', false);
                    }
                },
                error: function(){
                    console.log('error');
                }
            });
        }
    });
    
    $('input[name="check-all"]').change(function(){
       if(this.checked){
           $('input[name="messages[]"]').each(function(){
               $(this).prop('checked', true);
           });
       } else {
           $('input[name="messages[]"]').each(function(){
               $(this).prop('checked', false);
           });
       }
    });
</script>
@stop