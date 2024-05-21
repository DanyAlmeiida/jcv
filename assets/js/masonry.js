/**
 * Handles Masonry Layout
 */
( function($) {

	jQuery(document).ready(function ($) {

		var $container = $('.masonry-container .category-posts');

		if($container) {
			// Wrap into grid-item classes
			$('.category-posts article').wrap( "<div class='grid-item'></div>" );

            $container.imagesLoaded( function() {
              	// init Masonry after all images have loaded
                $container.masonry({
                    itemSelector : '.grid-item',
                    columnWidth:  '.grid-item'
                });
            });
        }
		
	});

} )(jQuery);


