<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="{{ asset('js/bootstrap-select.js') }}"></script>

<!--<script src="{{ asset('js/bootstrap.min.js') }}"></script>
-->

<script>
$(document).ready(function(){
    var selects = {
        'liveplace_country_id': 'liveplace_city_id',
        'birthplace_country_id': 'birthplace_city_id',
        'country': 'city'
    }
    
    $('select.select-country').change(function(){
        var $selectCity = $('.select-city[name="'+selects[$(this).attr('name')]+'"]');
        $.get("{{URL::to('country')}}"+"/"+$(this).val(),function($cities){
            cb = '';
            $.each($cities, function(key, value) {
                cb += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            $selectCity.html(cb);
        }).success(function(){
            $selectCity.trigger('refresh');
            $selectCity.selectpicker({
                liveSearch: true,
                maxOptions: 1
            });
            $selectCity.selectpicker('refresh');
        });
    });

    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
});
</script>
