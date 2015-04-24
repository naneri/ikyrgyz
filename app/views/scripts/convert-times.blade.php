{{HTML::script('js/moment-with-locales.js')}}
<script>
var times = {
    init: function(timesSelector){
        moment.locale('ru');
        $(timesSelector).hover(
            function(){
                $(this).find('.moment-time').hide();
                $(this).find('.original-time').show();
            },
            function(){
                $(this).find('.original-time').hide();
                $(this).find('.moment-time').show();
            }
        );
    },
    convert: function(selector){
        var $originalTime = $(selector).find('.original-time');
        var $momentTime = $(selector).find('.moment-time');
        var time = moment($originalTime.html(), "YYYY-MM-DD h:mm:ss").fromNow();
        $originalTime.hide();
        $momentTime.html(time);
    },
    eachConvert: function(eachSelector){
        $(eachSelector).each(function() {
            var $originalTime = $(this).find('.original-time');
            var $momentTime = $(this).find('.moment-time');
            var time = moment($originalTime.html(), "YYYY-MM-DD h:mm:ss").fromNow();
            $originalTime.hide();
            $momentTime.html(time);
        });
    }
};
</script>