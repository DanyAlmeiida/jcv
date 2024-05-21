<?php
/*
* Slick slider that shows featured posts from category 'featured'.
* 
* Slider Type 1: Standard one slide fullwidth slider
*
*/
if ( ! function_exists( 'rachel_post_slider' ) ) :
	/**
	 * Show a featured post slider
   *
   * @param $ppp: Number of posts to show
   * @param $template: Content template to use
   *
	 */
	function rachel_post_slider($ppp, $template) {

      $category = get_theme_mod('rachel_featured_category', 0);

      $layout_type = get_theme_mod('rachel_featured_layout', 'slider_fullwidth');

    	$loop = new WP_Query(array('post_type' => 'post', 'posts_per_page' => $ppp, 'orderby'=> 'ASC', 'cat' => $category));

      $hasArrows = get_theme_mod( 'rachel_featured_showarrows_checkbox', 1 ) == '1' ? 'true' : 'false';
      $hasDots = get_theme_mod( 'rachel_featured_showdots_checkbox', 1 ) == '1' ? 'true' : 'false';
      $hasAutoplay = get_theme_mod( 'rachel_featured_autoplay_checkbox', 0 ) == '1' ? 'true' : 'false';
      $hasFade = get_theme_mod( 'rachel_featured_fadeslide_radio', 'slide' ) == 'fade' ? 'true' : 'false';
        
      if( $loop->have_posts() ) { ?>
        <div data-slick='{"arrows": <?php echo $hasArrows; ?>, "dots": <?php echo $hasDots; ?>, "autoplay": <?php echo $hasAutoplay; ?>, "fade": <?php echo $hasFade; ?>}' class="featured-slider top-slider <?php echo ($layout_type == 'slider_contentwidth') ? 'small-width' : '' ?> <?php echo ($layout_type == 'slider_overlay') ? 'slider-overlay small-width' : '' ?>">
          <?php while ( $loop->have_posts() ) : $loop->the_post(); 
            get_template_part( 'template-parts/content/content', $template );
          endwhile; 
          ?>
        </div> <!-- End the Slick Carousel div -->
    <?php } 
      
   }
endif;



/*
* Slick slider that shows featured posts from category 'featured'.
* 
* Slider Type 2: Three-half slider with one centered slide
*
*/
if ( ! function_exists( 'rachel_centered_slider' ) ) :
  /**
   * Show a featured post slider
   *
   * @param $ppp: Number of posts to show
   * @param $template: Content template to use
   *
   */
  function rachel_centered_slider($ppp, $template) {

      $category = get_theme_mod('rachel_featured_category', 0);

      $loop = new WP_Query(array('post_type' => 'post', 'posts_per_page' => $ppp, 'orderby'=> 'ASC', 'cat' => $category));

      $hasArrows = get_theme_mod( 'rachel_featured_showarrows_checkbox', 1 ) == '1' ? 'true' : 'false';
      $hasDots = get_theme_mod( 'rachel_featured_showdots_checkbox', 1 ) == '1' ? 'true' : 'false';
      $hasAutoplay = get_theme_mod( 'rachel_featured_autoplay_checkbox', 0 ) == '1' ? 'true' : 'false'; 
      $hasFade = get_theme_mod( 'rachel_featured_fadeslide_radio', 'slide' ) == 'fade' ? 'true' : 'false'; 
        
      if( $loop->have_posts() ) { ?>
        <div data-slick='{"arrows": <?php echo $hasArrows; ?>, "dots": <?php echo $hasDots; ?>, "autoplay": <?php echo $hasAutoplay; ?>, "fade": <?php echo $hasFade; ?>}' class="featured-slider centered-slider">
          <?php while ( $loop->have_posts() ) : $loop->the_post(); 
            get_template_part( 'template-parts/content/content', $template );
          endwhile; 
          ?>
        </div> <!-- End the Slick Carousel div -->
    <?php } 
   }
endif;