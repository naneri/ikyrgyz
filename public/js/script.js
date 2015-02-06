

$(function(){
	$('.b-header__menu').click(function(){
		$('.b-header__navigation').toggle();
	});


});

 // $(document).ready(function() {
 //    $('.dropit').dropit();
 // });

$(function() {
	$('.b-header-nav li').hover(function(){
		$(this).children('ul').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('ul').stop(false, true).fadeOut(500);

	});
});


$(function() {
	$('.share-dropdown li').hover(function(){
		$(this).children('ul').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('ul').stop(false, true).fadeOut(500);

	});
});



$(function() {
	$('.create-dropdown li').hover(function(){
		$(this).children('ul').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('ul').stop(false, true).fadeOut(500);

	});
});


$(function() {
	$('.media-dropdown li').hover(function(){
		$(this).children('ul').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('ul').stop(false, true).fadeOut(500);

	});
});

$(function() {
	$('.icon-dropdown li').hover(function(){
		$(this).children('ul').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('ul').stop(false, true).fadeOut(500);

	});
});

$(function() {
	$('.b-user-wall-footer-list li ').hover(function(){
		$(this).children('ul').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('ul').stop(false, true).fadeOut(500);

	});
});

$(function() {
	$('ul.b-topic-navigation-list li  ').hover(function(){
		$(this).children('ul').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('ul').stop(false, true).fadeOut(500);

	});
});

$(function() {
	$('.b-topic-navigation__middle li  ').hover(function(){
		$(this).children('ul').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('ul').stop(false, true).fadeOut(500);

	});
});

$(function() {
	$('.b-topic-navigation-format li  ').hover(function(){
		$(this).children('ul').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('ul').stop(false, true).fadeOut(500);

	});
});



