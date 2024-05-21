/**
* Slick Slider Initializing
*/
(function($) {

	// Slider Type 1
	$('.top-slider').slick({
	    dots: true,
	    infinite: true,
	    speed: 700,
	    autoplaySpeed: 2000,
	    prevArrow: '<i class="prev-slide icon-chevron-left"></i>',
	    nextArrow: '<i class="next-slide icon-chevron-right"></i>'
	});

	// Slider Type 2
	$('.centered-slider').slick({
	  dots: true,
	  infinite: true,
	  speed: 700,
	  centerMode: true,
	  centerPadding: '300px',
	  slidesToShow: 1,
	  prevArrow: '<i class="prev-slide icon-chevron-left"></i>',
	  nextArrow: '<i class="next-slide icon-chevron-right"></i>',
	  responsive: [
	  	{
	      breakpoint: 1024,
	      settings: {
	        centerPadding: '80px',
	      }
	    },
	    {
	      breakpoint: 600,
	      settings: {
	      	centerPadding: '30px',
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	      	centerMode: false,
	      	centerPadding: '0px',
	      }
	    }
	   ]
	});

	// Posts Widget as Carousel
	$('.post-carousel').slick({
		dots: false,
	    infinite: true,
	    speed: 300,
	    prevArrow: '<i class="prev-slide icon-chevron-left"></i>',
	    nextArrow: '<i class="next-slide icon-chevron-right"></i>',
	    responsive: [
	  	{
	      breakpoint: 1024,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 3,
	      }
	    },
	    {
	      breakpoint: 600,
	      settings: {
	      	slidesToShow: 2,
	      	slidesToScroll: 2,
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	      	slidesToShow: 1,
	      	slidesToScroll: 1,
	      }
	    }
	   ]
	});

	$('#secondary .post-carousel').slick('unslick');

	// Posts Widget as Carousel in the Sidebar
	$('#secondary .post-carousel').slick({
		dots: false,
	    infinite: true,
	    speed: 300,
	    prevArrow: '<i class="prev-slide icon-chevron-left"></i>',
	    nextArrow: '<i class="next-slide icon-chevron-right"></i>',
	    responsive: [
	  	{
	      breakpoint: 1024,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1,
	      }
	    },
	    {
	      breakpoint: 768,
	      settings: {
	      	slidesToShow: 2,
	      	slidesToScroll: 2,
	      }
	    },
	    {
	      breakpoint: 620,
	      settings: {
	      	slidesToShow: 1,
	      	slidesToScroll: 1,
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	      	slidesToShow: 1,
	      	slidesToScroll: 1,
	      }
	    }
	   ]
	});

})(jQuery);