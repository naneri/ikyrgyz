<script>
var base_url = "{{$base_config['base_url']}}";
var page = 1;
	
$( function() {
  	var $container = $('.masonry').masonry({
    	columnWidth: 490
  	});
  

  $(window).scroll(function() {
	   if($(window).scrollTop() + $(window).height() == $(document).height()) {
	   		$.get(base_url + '/main/ajaxTopics/' + page, function(data){
		   		var elements = $(data).find(".b-user-wall");
		   		console.log(elements);
		   		$container.append( elements ).masonry( 'appended', elements );
		   		page += 1;
	   		});
	   }
	});
});
</script>