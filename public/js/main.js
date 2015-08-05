$(function() {
	$('.b-header-nav-user__item').hover(function(){
		$(this).children('.dropdown-list').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('.dropdown-list').stop(false, true).fadeOut(300);

	});
});
