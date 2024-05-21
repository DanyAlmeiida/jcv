<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package My_Boutique_Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function rachel_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'rachel_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function rachel_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'rachel_pingback_header' );


/**
* Replace [...] after automatic excerpts
*/
function rachel_excerpt_readmore($more) {
	global $post;
	if(get_theme_mod('rachel_readmore_checkbox', true) == true)
		return ' ...';
}
add_filter('excerpt_more', 'rachel_excerpt_readmore');


// Change length of automatic excerpt
function rachel_custom_excerpt_length( $length ) {
    return get_theme_mod('rachel_excerpt_length', 20);
}
add_filter( 'excerpt_length', 'rachel_custom_excerpt_length', 999 );



// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Disable Emojis
/**
 * Disable the emoji's
 */
function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
 add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
 if ( 'dns-prefetch' == $relation_type ) {
 /** This filter is documented in wp-includes/formatting.php */
 $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

$urls = array_diff( $urls, array( $emoji_svg_url ) );
 }

return $urls;
}


/*
*
* Numeric post navigation
* http://www.wpbeginner.com/wp-themes/how-to-add-numeric-pagination-in-your-wordpress-theme/
*
*/
function rachel_numeric_posts_nav() {
 
    // if( is_singular() )
    //     return;
 
    // global $wp_query;
 
    // /** Stop execution if there's only 1 page */
    // if( $wp_query->max_num_pages <= 1 )
    //     return;
 
    // $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    // $max   = intval( $wp_query->max_num_pages );
 
    // /** Add current page to the array */
    // if ( $paged >= 1 )
    //     $links[] = $paged;
 
    // /** Add the pages around the current page to the array */
    // if ( $paged >= 3 ) {
    //     $links[] = $paged - 1;
    //     $links[] = $paged - 2;
    // }
 
    // if ( ( $paged + 2 ) <= $max ) {
    //     $links[] = $paged + 2;
    //     $links[] = $paged + 1;
    // }
 
    // echo '<div class="numbered-navigation"><ul>' . "\n";
 
    // /** Previous Post Link */
    // if ( get_previous_posts_link() )
    //     printf( '<li class="arrow-left">%s</li>' . "\n", get_previous_posts_link( __("<  ") ) );
 
    // /** Link to first page, plus ellipses if necessary */
    // if ( ! in_array( 1, $links ) ) {
    //     $class = 1 == $paged ? ' class="active"' : '';
 
    //     printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
    //     if ( ! in_array( 2, $links ) )
    //         echo '<li>...</li>';
    // }
 
    // /** Link to current page, plus 2 pages in either direction if necessary */
    // sort( $links );
    // foreach ( (array) $links as $link ) {
    //     $class = $paged == $link ? ' class="active"' : '';
    //     printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    // }

    // if ( ! in_array( $max - 1, $links ) )
    //     echo '<li>...</li>' . "\n";
 
    // // /** Link to last page, plus ellipses if necessary */
    // // if ( ! in_array( $max, $links ) ) {
    // //     if ( ! in_array( $max - 1, $links ) )
    // //         echo '<li>…</li>' . "\n";
 
    // //     $class = $paged == $max ? ' class="active"' : '';
    // //     printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    // // }
 
    // /** Next Post Link */
    // if ( get_next_posts_link() )
    //     printf( '<li class="arrow-right">%s</li>' . "\n", get_next_posts_link( __("  >") ));
 
    // echo '</ul></div>' . "\n";


    the_posts_pagination( array(
        'mid_size'  => 1,
        'prev_text' => __( '&laquo;', 'rachel' ),
        'next_text' => __( '&raquo;', 'rachel' ),
    ) );
 
}


/*
* Add Images to RSS feed (for Bloglovin Support)
*/
function rachel_rss_featured_image($content) {
    global $post;
    if ( has_post_thumbnail( $post->ID ) ){
    $content = '<div>' . get_the_post_thumbnail( $post->ID, 'medium', array( 'style' => 'margin-bottom: 15px;' ) ) . '</div>' . $content;
    }
    return $content;
}
add_filter('the_excerpt_rss', 'rachel_rss_featured_image');
add_filter('the_content_feed', 'rachel_rss_featured_image');


/**
 * Return SVG markup.
 *
 * @param string $icon SVG icon id.
 * @return string $svg SVG markup.
 */
function rachel_get_svg( $icon = null ) {
    // Return early if no icon was defined.
    if ( empty( $icon ) ) {
        return;
    }

    // Create SVG markup.
    $svg = '<svg class="icon icon-' . esc_attr( $icon ) . '" aria-hidden="true" role="img">';
    $svg .= ' <use xlink:href="' . get_parent_theme_file_uri( '/assets/fonts/bytesize-symbols.min.svg#' ) . esc_html( $icon ) . '"></use> ';
    $svg .= '</svg>';

    return $svg;
}



add_filter( 'body_class','rachel_home_body_classes' );
function rachel_home_body_classes( $classes ) {

    if ( is_front_page() && !is_home() ) {
        // Static homepage
        $classes[] = 'static-home';

    } else if( is_front_page() && is_home() ) {
        // Blog Posts Page
        $classes[] = 'blog-home';
    }

    return $classes;

}