/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function($) {
	var container, button, menu, links, i, len;

	container = $('#mobile-navigation');

	button = $('.menu-toggle');
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = $('.mobile-menu-container');

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.attr( 'aria-expanded', 'false' );
	if ( -1 === menu.hasClass( 'nav-menu' ) ) {
		menu.addClass('nav-menu');
	}

	button.on('click', function() {
		// var container = $(this).parents('nav');
		// var menu = container.find('ul');

		// if ( $(this).hasClass('slide-down') ) {
		// 	slideDownMenu(container, menu);
		// } else {
			showFullwidthMenu(container, menu);
		//}
	});

	$('.menu-toggle.slide-2').on('click', function() {
		var container = $('#mobile-navigation');
		var menu = $('#mobile-navigation');
		slideDownMenu(container, menu);
	})

	function slideDownMenu(container, menu) {
		//var button = container.find('button');

		if ( container.hasClass( 'toggled' ) ) {
			button.attr( 'aria-expanded', 'false' );
			button.innerHTML = '<i class="icon-menu"></i>';
			menu.attr( 'aria-expanded', 'false' );
		} else {
			button.attr( 'aria-expanded', 'true' );
			button.innerHTML = '<i class="icon-delete close"></i>';
			menu.attr( 'aria-expanded', 'true' );
		}

		container.toggleClass('toggled');
		//menu.slideToggle();
	}

	function showFullwidthMenu(container, menu) {
		var button = container.find('button');
		
		if ( container.hasClass( 'toggled' ) ) {
			container.toggleClass('toggled');
			menu.slideUp();
			button.attr( 'aria-expanded', 'false' );
			button.find('i').attr('class', 'icon-menu'); //html('<i class="icon-menu"></i>');
			menu.attr( 'aria-expanded', 'false' );
		} else {
			container.toggleClass('toggled');
			menu.slideDown();
			button.attr( 'aria-expanded', 'true' );
			button.find('i').attr('class', 'icon-delete close'); //html('<i class="icon-delete close"></i>');
			menu.attr( 'aria-expanded', 'true' );
		}
	}

	// Close mechanism
	$('.close').on('click', function() {
		
		if ( container.hasClass( 'toggled' ) ) {
			button.attr( 'aria-expanded', 'false' );
			button.html('<i class="icon-menu"></i>');
			menu.attr( 'aria-expanded', 'false' );
		} else {
			button.attr( 'aria-expanded', 'true' );
			button.html('<i class="icon-delete close"></i>');
			menu.attr( 'aria-expanded', 'true' );
		}

		container.toggleClass('toggled');
		//$('#site-navigation .nav-menu').slideToggle();
	});


	// Open Newsletter Popup
	$('.newsletter-popup').on('click', function() {
		var id = $('.boxzilla-container .boxzilla:first').attr('id').split('-')[1];

		// Show the popup
		Boxzilla.show(id);
	})


	/* Add icons and click listeners to submenus */
	$submenu_link = $('.menu .menu-item-has-children');
	$submenu_link.find('a:eq(0)').append('<i class="icon-keyboard_arrow_down"></i>');
	
	// $('#mobile-navigation .menu-item-has-children .icon-keyboard_arrow_down').on('click', function(event) {
	// 	event.preventDefault();
	// 	$(this).parents('.menu-item').find('ul.sub-menu').slideToggle();
	// 	$(this).toggleClass("icon-up");
	// })

	$('#mobile-navigation .menu-item-has-children > a').on('touchstart click', function(event) {
		event.preventDefault();
		$(this).parents('li').find('ul.sub-menu').slideToggle();
		//$(this).find('i').toggleClass("icon-up");
	})

	// Get all the link elements within the menu.
	links    = menu.find( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}


	// Shopping/Boutique Page Mobile Menu
	$('.shopping-menu .mobile-menu').on('touchstart click', function(event) {
		event.preventDefault();
		$(this).next('.cat-menu').slideToggle();
	});

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.find( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );

/*
* Navigation sticky on scroll
*/
// $(window).scroll(function () {
//     if ($(window).scrollTop() > 350) {
//       $('.main-navigation').addClass('fixed');
//     }
//     if ($(window).scrollTop() < 351) {
//       $('.main-navigation').removeClass('fixed');
//     }
//   });

// Open Search Pop
$('.search-icon, .close-search').on('click', function() {
	$('.popup-search').fadeToggle();
});


// First word of header is colored 
if($('.site-header').find('img').length == 0) {

	var header = $('.site-header a').text().trim();

	if(header.trim().indexOf(' ') != -1) {	
	   var word = header.substr(0, header.indexOf(" "));
	   var rest = header.substr(header.indexOf(" "));
	   $('.site-header a').html('<span class="first">' + word + '</span>' + rest);
	}

}

})(jQuery);
