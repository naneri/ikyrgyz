<script>
	
	var base_url = "{{$base_config['base_url']}}";
	var page = 1;
		
	$(document).ready(function(){
		$( function() {

		  	var $container = $('.masonry');
	  		$container.imagesLoaded(function(){
	  			$container.masonry({
			    	columnWidth: 495,
			    	'gutter': 10
		  		});	
	  		});
                        
                        var inProgress = false;

		  	$(window).scroll(function() {
			   if($(window).scrollTop() + $(window).height() > $(document).height() - 100 && !inProgress) {
                                        inProgress = true;
                                        var array = document.URL.split('/');
                                        @if(!$no_sorting)
                                    		var sort = (array[array.length - 1].length > 1) ? array[array.length - 1] : array[array.length - 2]+ '/';
                                        @else
                                        	var sort = '';
                                        @endif
			   		$.get(base_url + '{{$page}}' + sort + page, function(data){

			   			// находим все блоки с классом .b-user-wall и добавляем в массив elements
			   			var elements = $(data).find(".b-user-wall");

				   		console.log('donwloaded elements' + page);

				   		// крепим новые элементы к контейнеру
				   		$container.append(elements).masonry( 'appended', elements );

				   		// располагаем новые элементы плиткой
				   		$container.imagesLoaded( function() {
						  $container.masonry('layout');
						});

				   		console.log(elements);

				   		// увеличиваем страничку на одну
				   		page += 1;
                                                inProgress = false;
			   		});
			   }
			});
		});
	})
</script>