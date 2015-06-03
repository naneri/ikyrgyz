

$(function(){
	$('.b-header__menu').click(function(){
		$('.b-header__navigation').toggle();
	});


});

 // $(document).ready(function() {
 //    $('.dropit').dropit();
 // });

$(function() {
	$('.b-header-nav-user__item').hover(function(){
		$(this).children('ul').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('ul').stop(false, true).fadeOut(500);

	});
});
$(function() {
	$('.b-header-nav-setting__item').hover(function(){
		$(this).children('ul').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('ul').stop(false, true).fadeOut(500);

	});
});

$(function() {
	$('.b-header-nav-dropdown li').hover(function(){
		$(this).children('ul').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('ul').stop(false, true).fadeOut(500);

	});
});

$(function() {
	$('.b-header-nav-button__item').hover(function(){
		$(this).children('ul').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('ul').stop(false, true).fadeOut(500);

	});
});
$(function() {
	$('.b-header-nav-enc__item').hover(function(){
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
	$('.b-user-wall-footer-list li ').hover(function(){
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
	
		$(' .b-friends-block-info-list__list_modal').click(function(event){
		

			$('.b-friends-block-info__edit .js-simple-modal').modal();
			event.preventDefault();

		});

});

$(function(){
	
		$('.b-friends-sort-list__list_modal').click(function(event){
		

			$('.b-friends-sort__sort .js-simple-modal').modal();
			event.preventDefault();

		});

});

$(function(){
	$('.b-topic-create__skin').hide();
		$('b-friends-sort-list__list:last-child').click(function(){


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


/*
$(document).ready(function() {

    $('input.pc-input').styler({
        filePlaceholder: 'Р¤Р°Р№Р» СЃ РєРѕРјРїСЊСЋС‚РµСЂР°',
        fileBrowse: 'Р’С‹Р±СЂР°С‚СЊ С„Р°Р№Р»'
    });
});


$(document).ready(function() {
    $('input.it-input').styler({
        filePlaceholder: 'Р¤Р°Р№Р» РёР· РёРЅС‚РµСЂРЅРµС‚Р°',
        fileBrowse: 'РЎСЃС‹Р»РєР°'

    });

});
*/

$(document).ready(function(){
    $('.select-default').styler({       

    });

});





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
	







  




// $(function () { 
//   $('ul.tabs li a').each(function () {
//     if (location.href == this.href) {
//       $(this).addClass('tabCurrentLink');
//     }
//   });
// });

// TABs


$(document).ready(function(){
	$('.b-header-nav__icon').click(function(){
		$('ul.b-header-nav-list').slideToggle();
	
});
});



$(document).ready(function(){
// Create a clone of the menu, right next to original.
$('.menu').addClass('original').clone().insertAfter('.menu').addClass('cloned').css('position','fixed').css('top','0').css('margin-top','0').css('z-index','500').removeClass('original').hide();

if($('.menu').length){
scrollIntervalID = setInterval(stickIt, 10);
}

function stickIt() {

  var orgElementPos = $('.original').offset();
  orgElementTop = orgElementPos.top;               

  if ($(window).scrollTop() >= (orgElementTop)) {
    // scrolled past the original position; now only show the cloned, sticky element.

    // Cloned element should always have same left position and width as original element.     
    orgElement = $('.original');
    coordsOrgElement = orgElement.offset();
    leftOrgElement = coordsOrgElement.left;  
    widthOrgElement = orgElement.css('width');
    $('.cloned').css('left',leftOrgElement+'px').css('top',0).css('width',widthOrgElement).show();
    $('.original').css('visibility','hidden');
  } else {
    // not scrolled past the menu; only show the original menu.
    $('.cloned').hide();
    $('.original').css('visibility','visible');
  }
}

});



$(function() {
	$('ul.b-topic-navigation-list li').hover(function(){
		$(this).children('ul').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('ul').stop(false, true).fadeOut(500);

	});
});


$(function() {
	$('.b-header-nav-enc__item').hover(function(){
		$(this).children('ul').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('ul').stop(false, true).fadeOut(500);

	});
});


$(function() {
	$('.b-topic-navigation__left .b-topic-navigation-menu__list ').hover(function(){
		$(this).children('dl').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('dl').stop(false, true).fadeOut(500);

	});
});


$(function() {
	$('.b-topic-navigation-choose__list').hover(function(){
		$(this).children('ul').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('ul').stop(false, true).fadeOut(500);

	});
});



$(function() {
	$('.b-topic-navigation-line').hover(function(){
		$(this).children('ul').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('ul').stop(false, true).fadeOut(500);

	});
});

$(function() {
	$('.b-topic-navigation-format').hover(function(){
		$(this).children('ul').stop(false, true ).fadeIn(300);
	}, function() {
		$(this).children('ul').stop(false, true).fadeOut(500);

	});
});


$(document).ready(function(){
	
$('.bigcheck1').bind('change', function () {

   if ($(this).is(':checked'))
     $(".item1").show();
   else
     $(".item1").hide();

});

});


$(document).ready(function(){

$('.bigcheck2').bind('change', function () {

   if ($(this).is(':checked'))
     $(".item2").show();
   else
     $(".item2").hide();

});

});
$(document).ready(function(){
	
$('.bigcheck3').bind('change', function () {

   if ($(this).is(':checked'))
     $(".item3").show();
   else
     $(".item3").hide();

});

});

$(document).ready(function(){
	
$('.bigcheck4').bind('change', function () {

   if ($(this).is(':checked'))
     $(".item4").show();
   else
     $(".item4").hide();

});

});

$(document).ready(function(){
	
$('.bigcheck5').bind('change', function () {

   if ($(this).is(':checked'))
     $(".item5").show();
   else
     $(".item5").hide();

});

});

$(document).ready(function(){
	
$('.bigcheck6').bind('change', function () {

   if ($(this).is(':checked'))
     $(".item6").show();
   else
     $(".item6").hide();

});

});


$(document).ready(function() {
	var status = $('.b-topic-navigation-sort__item')[0]
        var location = window.location;
        var pattNew = /main\/index/;
        var pattTop = /main\/index\/top/;
	if(pattTop.test(location)){
            $($('.b-topic-navigation-sort__item')[1]).append('<div class="online-icon"></div>');
        }else if(pattNew.test(location)){
            $($('.b-topic-navigation-sort__item')[0]).append('<div class="online-icon"></div>');
        } 
        
	//$(status).append('<div class="online-icon"></div>')

	$('.online-icon').css('display', 'block');

});

$(document).ready(function() {
	var online = $('.b-topic-navigation-line .dropdown-list li')
	
	
	$(online).append('<div class="online-icon"></div>')
	$('.online-icon').css('display', 'block');
	
	
});


$(document).ready(function() {
	$('.b-header-nav-icon-search').click(function(){
		$('.b-search').toggle();
	})


});

$(document).ready(function(){
	$('.b-header-nav-menu__item').click(function(event){
		  event.stopPropagation();
	$('.b-header-nav-menu .b-topic-navigation-menu ').toggle();	
		  var docHeight = $(document).height();

   $(".b-content").append("<div id='overlay'></div>");

   $("#overlay")
      .height(docHeight)
      .css({
         'opacity' : 0.4,
         'position': 'absolute',
         'top': 0,
         'left': 0,
         'background-color': 'black',
         'width': '100%',
         'z-index': 1000,

      });
	
	});


	
   

});


$(document).click( function(){
        $(' .b-header-nav-menu  .b-topic-navigation-menu').hide();
       	$('#overlay').remove();
    });


$(document).ready(function(){
	
	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

})


$(document).ready(function(){
	
	$('ul.tab li').click(function(e){
            e.preventDefault();
		var tab_id = $(this).attr('data-tab');

		$('ul.tab li').removeClass('currents');
		$('.tab-contents').removeClass('currents');

		$(this).addClass('currents');
		$("#"+tab_id).addClass('currents');
	})

})









$(function() {
	$('.b-friends-sort__sort .button-select').click(function(event){
		event.preventDefault();
	$('.b-friends-sort-list ').toggle();
});

});

$(function() {
	$('.b-friends-block-info__edit .button-select').click(function(event){
		event.preventDefault();

	$(this).next('.b-friends-block-info-list').toggle();
});

});

$(function() {
//	$('.b-message-ls-mark-button .button-select').click(function(event){
//		event.preventDefault();
//	$('.b-message-ls-mark-button-list a').toggle();
//});

});



$(function() {
	$('.b-profile-middle__button').click(function(event){
		event.preventDefault();

	$('.full-information').toggle();
});

});


$(document).ready(function () {
    $('.b-message-tabs-list__list').click(function(e) {

        $('.b-message-tabs-list__list').removeClass('active');

        var $this = $(this);
        if (!$this.hasClass('active')) {
            $this.addClass('active');
        }
        //e.preventDefault();
    });
});



