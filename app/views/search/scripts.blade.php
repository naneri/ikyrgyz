<script>
$(document).ready(function(){ 
    
        startSearch();
        
        $('input, select').change(function(){
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
            timer = setTimeout(startSearch, 1000);
        }
        
        function startSearch(){
            
            data = $('form').serialize();
            
            $.ajax({
                url: window.location,//"{{asset('/search/people')}}",
                data: data,
                dataType: 'json',
                type: 'POST',
                success: function(result){
                    if(!result['errors']){
                        $('#search-result').html(result.entries);
                    }
                },
                error: function(result) {
                }
            });
        }        

        $('#btn-search').click(function() {
            startSearch();
        });
});
</script>
