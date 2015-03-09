<script>
$(document).ready(function(){
    var selects = {
        'liveplace_country_id': 'liveplace_city_id',
        'birthplace_country_id': 'birthplace_city_id',
        'country': 'city'
    }
    
    $('.select-country').change(function(){
        var $selectCity = $('.select-city[name="'+selects[$(this).attr('name')]+'"]');
        $.get("{{URL::to('country')}}"+"/"+$(this).val(),function($cities){
            cb = '';
            $.each($cities, function(key, value) {
                cb += '<option value="' + key + '">' + value + '</option>';
            });
            $selectCity.html(cb);
        });
    });
});
</script>
