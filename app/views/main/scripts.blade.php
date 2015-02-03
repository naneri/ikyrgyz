<script>

var base_url = "{{$base_config['base_url']}}";
var page = 1;
	$(window).scroll(function() {
	   if($(window).scrollTop() + $(window).height() == $(document).height()) {
	       	$.get(base_url + '/main/ajaxTopics/' + page, function(data){
	       		$('.b-section-wall__inner').last().append(data);
	       		page += 1;
	       	});
	   }
	});

</script>