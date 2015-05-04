{{HTML::script('js/moment-with-locales.js')}}
<script>
var times = {
    init: function(timesSelector){
        moment.locale('ru');
        $(timesSelector).hover(
            function(){
                $(this).find('.moment-time').hide();
                $(this).find('.moment-time-hover').show();
            },
            function(){
                $(this).find('.moment-time-hover').hide();
                $(this).find('.moment-time').show();
            }
        );
    },
    convert: function(selector){
        var $originalTime = $(selector).find('.original-time');
        var $momentTime = $(selector).find('.moment-time');
        var $momentTimeHover = $(selector).find('.moment-time-hover');
        
        var time = moment($originalTime.html(), "YYYY-MM-DD h:mm:ss").fromNow();
        var timeHover = moment($originalTime.html(), "YYYY-MM-DD h:mm:ss").format('LLL');
        
        $momentTimeHover.hide();
        $originalTime.hide();
        
        $momentTime.html(time);
        $momentTimeHover.html(timeHover);
    },
    eachConvert: function(eachSelector){
        $(eachSelector).each(function() {
            times.convert($(this));
        });
    }
};
</script>