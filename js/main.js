(function($) {

'use strict';

	
jQuery(document).on('ready', function(){
	
	/*PRELOADER JS*/
	$(window).on('load', function() { 
		$('.preloader').fadeOut();
		$('.status-mes').delay(350).fadeOut('slow'); 
	}); 
	/*END PRELOADER JS*/
	
	
	/*DROPDOWN JS*/
	

	 /*Start Search JS*/
	 window.REMODAL_GLOBALS = {
		  NAMESPACE: 'modal',
		  DEFAULTS: {
			hashTracking: false
		  }
		};
	 
	/*	Mobile Menu
	------------------------*/
	$('.mobile-menu nav').meanmenu({
		meanScreenWidth: "767",
		meanMenuContainer: ".header_btm_area .col-xs-12.col-sm-12.col-lg-9",
	});
	 
	// jQuery Lightbox
	jQuery('.lightbox').venobox({
		numeratio: true,
		infinigall: true
	});	
	

	$('.venobox').venobox(); 
	
	
	// Declare Carousel jquery object
	var slider_active = $('.slider_active');
	slider_active.owlCarousel({
		loop:true,
		navText:['<i class="fa fa-long-arrow-left"></i>','<i class="fa fa-long-arrow-right"></i>'],
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		smartSpeed:450,
		autoplay:true,
		autoplayTimeout:9000,
		mouseDrag:false,
		nav:true,
		dots:true,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:1
			}
		}
	});
	
	// Countdown
	  
	  $('#countdown').countdown('2023/3/10', function(event) {
		var $this = $(this).html(event.strftime(''
			
			+ '<div><strong>%D</strong> <br />Days </div>'
			+ '<div><strong>%H</strong> <br />Hours </div>'
			+ '<div><strong>%M</strong> <br />Min </div>'
			+ '<div><strong>%S</strong> <br />Secs </div>'));
		});
	  
	// Testimonials slider 		

	var testi_active = $('#testimonial-slider');
	testi_active.owlCarousel({
		loop:true,
		navText:['<i class="pe-7s-angle-left"></i>','<i class="pe-7s-angle-right"></i>'],
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		smartSpeed:450,
		autoplay:true,
		autoplayTimeout:9000,
		mouseDrag:true,
		nav:true,
		dots:false,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:2
			},
			1000:{
				items:3
			}
		}
	});	
	
	// brand slider 
	$('.brand_slide').owlCarousel({
		loop:true,
		dots:true,
		autoplay:true,
		responsiveClass:true,
		items : 6, //10 items above 1000px browser width
		responsive:{
			0:{
				items:2,
				nav:false
			},
			400:{
				items:2,
				nav:false
			},
			600:{
				items:3,
				nav:false
			},
			1000:{
				items:6,
				nav:false,
				loop:true
			}
		}
	})
	
	
	// testimonial slider 		
	$('.test_slide').owlCarousel({
		autoplay:false,
		responsiveClass:true,
		items : 1, //10 items above 1000px browser width
		responsive:{
			0:{
				items:1,
				nav:false
			},
			600:{
				items:1,
				nav:false
			},
			1000:{
				items:1,
				nav:false,
			}
		}
	});		



	// Counter 
	$('.counter').counterUp({
		delay: 10,
		time: 1000
	});


	// jQuery MixItUp
	$('.product_item').mixItUp();
	
	 // Vide Section
	$("#video").simplePlayer();
	

	
	
});

new WOW().init();

})(jQuery);	
