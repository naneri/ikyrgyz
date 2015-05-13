@include('scripts.convert-times')
<script>
	var base_url = "{{$base_config['base_url']}}";
	var page = 1;
        
        function timesConvert(){
            times.init('.b-user-wall-header__date');
            times.eachConvert('.b-user-wall');
        }
		
    
	$(document).ready(function(){
            timesConvert();
            $( function() {
                    
            var $container = $('.masonry');
            
            @if(@$columnN)
                var ColumnN = {{ $_COOKIE['ColumnN'] }};
                var columnWidth, masonryClass;

                if(ColumnN == 1){
                    columnWidth = 650;
                    masonryClass = 'b-user-wall-1000';
                }
                else if(ColumnN == 2){
                    columnWidth = 495;
                    masonryClass = 'b-user-wall-495';
                }
                else if(ColumnN == 3){
                    columnWidth = 325;
                    masonryClass = 'b-user-wall-325';
                }
                
                $container.find('.b-user-wall').removeClass('b-user-wall-325').removeClass('b-user-wall-495').removeClass('b-user-wall-1000').addClass(masonryClass);
            @else
                var columnWidth = 500;
                $container.find('.b-user-wall').removeClass('b-user-wall-325').removeClass('b-user-wall-495').removeClass('b-user-wall-1000').addClass('b-user-wall-495');
            @endif
            
            $container.imagesLoaded(function(){
                    $container.masonry({
                    columnWidth: columnWidth,
                    'gutter': 10,
                    stamp: '.b-user-media'
                    });	
            });
            $('.masonry').css('display', 'block');

            var inProgress = false;

            $(window).scroll(function() {
                if($(window).scrollTop() + $(window).height() > $(document).height() - 100 && !inProgress) {
                    inProgress = true;
                    var array = document.URL.split('/');
                    @if(@$no_sorting)
                        var sort = '';
                    @else
                        var sort = (array[array.length - 1].length > 1) ? array[array.length - 1] : array[array.length - 2];
                    @endif
                    $.get(base_url + '{{$page}}' + sort + '/' + page, function(data){
                            // находим все блоки с классом .b-user-wall и добавляем в массив elements
                            var elements = $(data).find(".b-user-wall");

                            console.log('donwloaded elements' + page);
                            
                            @if(@$columnN)
                                var ColumnN;
                                if($('#ColumnN').val() == "")
                                    ColumnN = {{ $_COOKIE['ColumnN'] }};
                                else
                                    ColumnN = $('#ColumnN').val();

                                if(ColumnN == 1) elements.addClass('b-user-wall-1000');
                                else if(ColumnN == 2) elements.addClass('b-user-wall-495');
                                else if(ColumnN == 3) elements.addClass('b-user-wall-325');
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

                            console.log(elements);

                            // увеличиваем страничку на одну
                            page += 1;
                            inProgress = false;
                    });
                }
            });
        });
    })
    
    @if(@$columnN)
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
    @endif

    function popitup(url) {
        newwindow=window.open(url,'name','height=400,width=400');
        if (window.focus) {newwindow.focus()}
        return false;
    }
</script>