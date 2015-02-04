<script>
$(document).ready(function(){ 
        
        $('input').change(function(){
            setSearchTimeout();
        });
        
        $('input').keyup(function(){
            setSearchTimeout(); 
        });
        
        var timer = null;
        
        function setSearchTimeout(){
            if (timer) {
                clearTimeout(timer); //cancel the previous timer.
                timer = null;
            }
            timer = setTimeout(searchPeople, 1000);
        }
        
        function searchPeople(){
            
            data = $('form').serialize();
            
            $.ajax({
                url: "{{asset('/search/people')}}",
                data: data,
                dataType: 'json',
                type: 'POST',
                success: function(result){
                    if(!result['errors']){
                        $('#users-list').html(result.users);
                    }
                },
                error: function(result) {
                }
            });
        }        
});
</script>
