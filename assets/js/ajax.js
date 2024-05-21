/**
 * File ajax.js
 *
 * Handles ajax laoding of category posts on the homepage
 *
 */
( function($) {

var $content = $('.category-posts');
var $headline = $('.ajax-cat-name');

//* Streetstyle Category Load 
var $category_button = $('#category-filter button');

$category_button.on('click', function(event) {
    // Prevent normal link functionality
    event.preventDefault();

    // Get the data and category
    var $container = $(this).parents('.category-thumbnails');

    var cat_id = $(this).data('category');
    var ppp = $container.data('posts');
    var cols = $container.data('columns');
    var template = $container.data('template');
    var cat_slug = $(this).data('catname');

    // Remove all 'selected' classes
    $category_button.removeClass('selected');
    // Add class 'selected' to the clicked item
    $(this).addClass('selected');

    // Change h3 title with category name
    $headline.text(cat_slug);

    // Then call ajax function with slug 
    load_ajax_cat_posts( cat_id, ppp, cols, template );
});

//* Ajax Cat Function for Homepage
function load_ajax_cat_posts( cat, ppp, cols, template ) {

    $loader = $('<div class="loader"/>');

    $.ajax({
            type: 'POST',
            dataType: 'html',
            url: ajaxpagination.ajaxurl,
            data: {
                'cat': cat,
                'ppp': ppp,
                'cols': cols,
                'template': template,
                'action': 'rachel_category_post_ajax'
            },
            beforeSend : function () {
                //$content.find('article').animate({ opacity: 0 });
                //setTimeout(function() {
                    $content.find('article').removeClass('in').addClass('out');
                //}, 800);
                // $content.css({ opacity: 0 });
                // $loader.show();
                //$no_posts.hide();
            },
            success: function (data) {
                var $newElements = $(data);
                $content.html($newElements);
                
                if($content.parents('.widget-content').hasClass('masonry-container')) {

                    // Wrap into grid-item classes
                    $('.category-posts article').wrap( "<div class='grid-item'></div>" );
                    
                    // Masonry reload workaround
                    $content.imagesLoaded( function() {
                      // init Masonry after all images have loaded
                        $content.masonry({
                            itemSelector : '.grid-item',
                            columnWidth:  '.grid-item'
                        });
                    });
                    //setTimeout(function() {
                        $content.masonry().masonry('reloadItems').masonry();

                        $newElements.find('article').addClass('in');
                        //$loader.hide();

                   // }, 200);
                } else {
                    $newElements.find('article').addClass('in');
                    //$loader.hide();
                }


            },
            error : function (jqXHR, textStatus, errorThrown) {
                $loader.html($.parseJSON(jqXHR.responseText) + ' :: ' + textStatus + ' :: ' + errorThrown);
                // console.log(jqXHR);
                // $no_posts.show();
            },
        });
}

} )(jQuery);




