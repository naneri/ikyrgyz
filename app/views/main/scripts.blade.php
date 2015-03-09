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

		  	$(window).scroll(function() {
			   if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
			   		$.get(base_url + '/main/ajaxTopics/' + page, function(data){

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
			   		});
			   }
			});
		});
	})
</script>