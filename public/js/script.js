

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

$(function() {
	$('.dropdown li').hover(function(){
		$(this).children('.sub-dropdown').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('.sub-dropdown').stop(false, true).fadeOut(500);

	});
});

// $(function(){
	
// 	$('.b-topic-create-modal').dialog({
// 		modal: true,	
// 		autoOpen: false,
// 		dialogClass:"myClass"			         
// 	 });
// 	$('#opener').click(function(){
// 		$('.b-topic-create-modal').dialog('open');
// 	});
// });

// $(document).ready(function(){	 
//     $(".ui-dialog").addClass(".b-topic-create-modal__inner");
//  	$('.ui-dialog-title').addClass('.b-topic-create-modal__title');
//  	$('.b-topic-create-modal__header button').addClass('.ul-button');
 	
   
// });



$(function(){
	$('.b-topic-create__gallery').hide();
		$('.input-default.add-gallery-btn').click(function(){


			$('.b-topic-create__gallery').modal({
				opacity: 80,
				overlayCss: {backgroundColor: "#000"}


			});

		});

});


$(function(){
	$('.b-topic-create__music').hide();
		$('.input-default.add-music-btn').click(function(){


			$('.b-topic-create__music').modal({
				opacity: 80,
				overlayCss: {backgroundColor: "#000"}


			});

		});

});

$(function(){
	$('.b-topic-create__skin').hide();
		$('a.input-default.change-skin').click(function(){


			$('.b-topic-create__skin').modal({
				opacity: 80,
				overlayCss: {backgroundColor: "#000"}


			});

		});

});




$(function(){
    /* Hide form input values on focus*/ 
    $('input:text').each(function(){
        var txtval = $(this).val();
        $(this).focus(function(){
            if($(this).val() == txtval){
                $(this).val('')
            }
        });
        $(this).blur(function(){
            if($(this).val() == ""){
                $(this).val(txtval);
            }
        });
    });
});


$(function(){
    /* Hide form input values on focus*/ 
    $('textarea').each(function(){
        var txtval = $(this).val();
        $(this).focus(function(){
            if($(this).val() == txtval){
                $(this).val('')
            }
        });
        $(this).blur(function(){
            if($(this).val() == ""){
                $(this).val(txtval);
            }
        });
    });
});



$(document).ready(function(){
  
  $('input.pc-input').styler({
  	filePlaceholder: 'Файл с компьютера',
  	fileBrowse: 'Выбрать файл'
  });  
  });


$(document).ready(function(){
  $('input.it-input').styler({
  	filePlaceholder: 'Файл из интернета',
  	fileBrowse: 'Ссылка'
  	
  });  

});
  




// (function($) {  
// $(function() {  
  
// $('select').styler();  
  
// })  
// })(jQuery);


// $(document).ready(function(){
// 	var audioArray = $('.playsong');
// 	var nowPlaying = audioArray[i=0];
// 	nowPlaying.load();
// 	$('.play').on('click', function(){
// 		nowPlaying.play();
// 	},
// 	$(this).on('click', function(){
// 		nowPlaying.pause();
// 	});
	
// });


// Hide Pause Button
	var audio;

$(document).ready(function(){

$('.stop').hide();
var audio = new Audio('zhu-faded.mp3');
$('#play').click(function(){
audio.play();
$('#play').hide();
$('.stop').show();
});

$('.stop').click(function(){
audio.pause();
$('.stop').hide();
$('#play').show();
});


});




	 $(document).ready(function(){ $('.b-user-interface-tab').easytabs(); });



$(document).ready(function(){
  $('.select-default').styler();
  	


  	
  

});
  