<?php
/**
 * All theme custom functions and tags (not in the framework) go in here.
 *
 * @package My_Boutique_Theme
 */

// Allow HTML tags in Widget title 
function html_widget_title( $var) {
	$var = (str_replace( '[span]', '<span>', $var ));
	$var = (str_replace( '[/span]', '</span>', $var ));
	return $var ;
		
}
add_filter( 'widget_title', 'html_widget_title' );


// Set number of posts on archive pages
function wpsites_query( $query ) {
if ( ($query->is_archive() || $query->is_search() ) && $query->is_main_query() && !is_admin() ) {
        $query->set( 'posts_per_page', 9 );
    }
}
add_action( 'pre_get_posts', 'wpsites_query' );


// Re-build posts navigation
function rachel_posts_navigation() {
	?>
	<nav class="posts-navigation">
		<div class="nav-links">
		  <div class="nav-previous"><p>Previous Article</p><?php previous_post_link() ?></div>
		  <div class="nav-next"><p>Next Article</p><?php next_post_link() ?></div>
		</div>
	</nav>
	<?php 
}

// Next Post slide-in
function rachel_next_post_slider() {
	$nextPost = get_next_post(true);
        if($nextPost) {
            $args = array(
                'posts_per_page' => 1,
                'include' => $nextPost->ID
            );
            $nextPost = get_posts($args);
            foreach ($nextPost as $post) {
                setup_postdata($post);
		    	?>
		        <div class="next-post-box">
		            <a class="next" href="<?php the_permalink(); ?>"><?php echo __('Next Story &raquo;', 'rachel') ?></a>
		            <div class="next-thumbnail-title">
		            	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
		            	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		        	</div>
		        </div>
		    <?php
            wp_reset_postdata();
            } //end foreach
        } // end if
}
			

// Popup Search Function
function rachel_popup_search() {
	?>
	<div class="popup-search">
		<div class="search-container">
			<i class="icon-delete close-search"></i>
			<h2><?php echo __('What are you looking for?', 'rachel'); ?></h2>
			<form role="search" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
				<label for="search-top"><i class="icon-search-bold"></i></label>
			    <input type="text" id="search-top" placeholder="<?php echo esc_attr( 'Type search', 'rachel' ); ?>" value="" name="s" id="s" />
			</form>
		</div>
	</div>
	<?php
}