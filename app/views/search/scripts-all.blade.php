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

    function startSearch()
    {
        data = $('form').serialize();
        $.ajax({
            method: "POST",
            url: "{{$base_config['base_url']}}/search/people",
            data: data,
            success: function(result) {
                if(!result['errors'] && $.trim(result.entries) != "По данным критериям пользователей не найдено"){
                    $('#search-result-people').css("display", 'block');
                    $('#search-result-people').html(result.entries);
                } else {
                    $('#search-result-people').css("display", 'none');
                    $('#search-result-people').html("");
                }
            }
        });
        $.ajax({
            method: "POST",
            url: "{{$base_config['base_url']}}/search/content",
            data: data,
            success: function(result) {
                if(!result['errors']){
                    $('#search-result-content').css("display", "block");
                    $('#search-result-content').html(result.entries);
                } else {
                    $('#search-result-content').css("display", "none");
                    $('#search-result-content').html("");
                }
            }
        });
    }

        $('#btn-search').click(function() {
            startSearch();
        });

        $('select[name=age-from]').change(function(){
            var beginNum = $(this).val();
            var items = '<option value=""></option>';
            for(var i=beginNum;i<100;i++){
                 items += '<option value="' + i + '">' + i + '</option>';
            }
            $('select[name=age-to]').html( items);
        });
});
</script>
