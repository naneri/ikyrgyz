<script>
	
	var base_url = "{{$base_config['base_url']}}";
	var page = 1;
		
	$(document).ready(function(){
		$( function() {

		  	var $container = $('.masonry');
		  	setTimeout(function(){
			  		$container.masonry({
			    	columnWidth: 490,
			    	'gutter': 10
		  		});
		  	}, 200);

		  	$(window).scroll(function() {
			   if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
			   		$.get(base_url + '/main/ajaxTopics/' + page, function(data){
				   		var elements = $(data).find(".b-user-wall");
				   		console.log('donwloaded elements' + page);
				   		setTimeout($container.append( elements ).masonry( 'appended', elements ), 200);
				   		elements = null;
				   		console.log(elements);
				   		page += 1;
			   		});
			   }
			});
		});
	})
</script>