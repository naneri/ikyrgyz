<script>
$(document).ready(function(){ 
        
        $('input[type="checkbox"]').change(function(){
            setUpdateTimeout();
        });
        
        $('input').keyup(function(){
            setUpdateTimeout(); 
        });
        
        var timer = null;
        
        function setUpdateTimeout(){
            if (timer) {
                clearTimeout(timer); //cancel the previous timer.
                timer = null;
            }
            timer = setTimeout(updateForm, 1000);
        }
        
        function updateForm(){
            
            data = $('form').serialize();
            
            $.ajax({
                url: "{{asset('/search/people')}}",
                data: data,
                dataType: 'json',
                type: 'POST',
                success: function(result){
                    if(result['users'] && !result['errors']){
                        $('#users-list').html(result.users);
                    }
                },
                error: function(result) {
                }
            });
        }
        
});
</script>
