/**
 * File changes.js
 *
 * All kinds of javascript changes and functions
 *
 */
( function($) {

// Change tagname of posts featured row when inside another section
$('.featured-row').each(function() {

	if($(this).parents('.widget').length) {
		var classes = $(this).attr('class');
		$(this).replaceWith('<div class="' + classes + '">' + $(this).html() +'</div>');
	}

})


} )(jQuery);