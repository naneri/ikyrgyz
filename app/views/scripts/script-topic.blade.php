@include('scripts.convert-times')
<script>
	var base_url = "{{$base_config['base_url']}}";
	
        
    function timesConvert(){
        times.init('.b-user-wall-header__date');
        times.eachConvert('.b-user-wall');
    }
	
    
	$(document).ready(function(){
            timesConvert();
            var page = 1;
            $( function() {
                    
            var $container = $('.masonry');
           
            var ColumnN = niamiko.column;
            var columnWidth, masonryClass, columnSettings;

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
            columnWidth     = settings[ColumnN].columnWidth;
            masonryClass    = settings[ColumnN].masonryClass;
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
                    
                    $.get(base_url + '{{$page}}', parameters).done(function(data){
                        
                        // находим все блоки с классом .b-user-wall и добавляем в массив elements
                        var elements = $(data).find(".b-user-wall");
                        
                        @if(@$columnN)

                            var ColumnN = $('#ColumnN').val() || niamiko.column;
                            elements.addClass(settings[ColumnN].masonryClass);

                        @else

                            elements.addClass('b-user-wall-495');

                        @endif
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

            if(column == 1){
                columnWidth = 650;
                masonryClass = 'b-user-wall-1000';
                document.cookie = 'ColumnN = 1';
                $('#ColumnN').val('1');
            }
            else if(column == 2){
                columnWidth = 495;
                masonryClass = 'b-user-wall-495';
                document.cookie = 'ColumnN = 2';
                $('#ColumnN').val('2');
            }
            else if(column == 3){
                columnWidth = 325;
                masonryClass = 'b-user-wall-325';
                document.cookie = 'ColumnN = 3';
                $('#ColumnN').val('3');
            }

            var $container = $('.masonry');
            $container.imagesLoaded(function(){
                $container.masonry({
                    columnWidth: columnWidth,
                    'gutter': 10,
                    stamp: '.b-user-media'
                });
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