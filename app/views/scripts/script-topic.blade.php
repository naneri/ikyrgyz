@include('scripts.convert-times')
<script>
	
    function timesConvert(){
        times.init('.b-user-wall-header__date');
        times.eachConvert('.b-user-wall');
    }
	
    settings = {
        '1' : {
            columnWidth : 650,
            masonryClass: 'b-user-wall-1000'
        },
        '2' : {
            columnWidth : 495,
            masonryClass: 'b-user-wall-495'
        },
        '3' : {
            columnWidth : 325,
            masonryClass: 'b-user-wall-325'
        }
    }
    
	$(document).ready(function(){
            timesConvert();
            var page = 1;
            $( function() {
             
            // defining the container for the Masonry         
            var $container = $('.masonry');
           
            var columnWidth, masonryClass;

            columnWidth     = settings[niamiko.column].columnWidth;
            masonryClass    = settings[niamiko.column].masonryClass;
            $container.find('.b-user-wall').removeClass('b-user-wall-325').removeClass('b-user-wall-495').removeClass('b-user-wall-1000').addClass(masonryClass);
          
            
            $container.imagesLoaded(function(){
                    $container.masonry({
                    columnWidth: columnWidth,
                    'gutter': 10,
                    stamp: '.b-user-media'
                    });	
            });

            var inProgress = false;

            $(window).scroll(function() {
                if($(window).scrollTop() + $(window).height() > $(document).height() - 100 && !inProgress) {
                    inProgress = true;
                   
                    //console.log(sort);
                    var parameters = {
                        sort : niamiko.sort || '',
                        page : page
                    }
                    
                    $.get(niamiko.base_url + '{{$page}}', parameters).done(function(data){
                        
                        // находим все блоки с классом .b-user-wall и добавляем в массив elements
                        var elements = $(data).find(".b-user-wall");
                        
                        var ColumnN = $('#ColumnN').val() || niamiko.column;
                        elements.addClass(settings[ColumnN].masonryClass);

                        // крепим новые элементы к контейнеру
                        $container.append(elements).masonry( 'appended', elements );

                        // располагаем новые элементы плиткой
                        $container.imagesLoaded( function() {
                            $container.masonry('layout');
                        });
                        
                        timesConvert();

                        // увеличиваем страничку на одну
                        page += 1;
                        inProgress = false;
                    });
                }
            });
        });
    })
    
    function makeColumnN(column){
        var columnWidth;
        var masonryClass;

        columnWidth     = settings[column].columnWidth;
        masonryClass    = settings[column].masonryClass;
        document.cookie = 'ColumnN = ' + column;
        $('#ColumnN').val(column);    
        
        var $container = $('.masonry');
        $container.masonry({
            columnWidth: columnWidth,
            'gutter': 10,
            stamp: '.b-user-media'
        });
        $container.children().removeClass('b-user-wall-325').removeClass('b-user-wall-495').removeClass('b-user-wall-1000').addClass(masonryClass);
        $container.masonry('layout');
    }

    function popitup(url) {
        newwindow=window.open(url,'name','height=400,width=400');
        if (window.focus) {newwindow.focus()}
        return false;
    }
</script>