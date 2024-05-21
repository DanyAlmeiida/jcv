<?php 
if ( ! function_exists( 'rachel_featured_row' ) ) :
	/**
	 * Shows a number of featured posts with thumbnail in a row.
	 * 
	 * @param $ppp: Number of posts to show
	 * @param $template: Content template to use
	 * @param $carousel: option to make it a carousel
	 */
	function rachel_featured_row($template, $ppp, $cat, $col, $carousel) {

		$featured_args = array('post_type' => 'post', 'posts_per_page' => $ppp, 'orderby'=> 'ASC', 'category_name' => $cat); //WP Query for Featured Posts on top 

		?>

		<div <?php if($carousel) : ?> data-slick='{"slidesToShow": <?php echo $col ?> , "slidesToScroll": 1}' <?php endif; ?> class="<?php echo ($carousel) ? 'post-carousel' : 'featured-row col-' . $col ?> featured">
      
	        <?php
	        /* 
	        * Invoke a custom WP-query
	        */
	        rachel_custom_query($featured_args, $template);
	        ?>

	    </div>

	    <?php
    }
endif;


if ( ! function_exists( 'rachel_featured_grid' ) ) :
	/**
	 * Shows a grid of featured posts with thumbnail.
	 * 
	 * @param $ppp: Number of posts to show
	 * @param $col: Number of columns
	 * @param $template: Content template to use
	 */
	function rachel_featured_grid($template, $ppp, $cat, $col) {

		$featured_args = array('post_type' => 'post', 'posts_per_page' => $ppp, 'orderby'=> 'ASC', 'category_name' => $cat); 
		?>

		<section class="featured-grid featured-row col-<?php echo $col?>">
      
	        <?php
	        /* 
	        * Invoke a custom WP-query
	        */
	        rachel_custom_query($featured_args, $template);
	        ?>

	    </section>

	    <?php
    }
endif;


if ( ! function_exists( 'rachel_popular_grid' ) ) :
	/**
	 * Shows a grid of featured posts with thumbnail.
	 * 
	 * @param $ppp: Number of posts to show
	 * @param $col: Number of columns
	 * @param $template: Content template to use
	 */
	function rachel_popular_grid($template, $ppp, $cat, $col) {

		$popular_posts_args = array(
		    'posts_per_page' => $ppp,
		    'meta_key' => 'rachel_post_viewed',
		    'orderby' => 'meta_value_num',
		    'order'=> 'DESC',
		    'category_name' => $cat
		);
		?>

		<div class="featured-grid featured-row popular-grid col-<?php echo $col?>">
      
	        <?php
	        /* 
	        * Invoke a custom WP-query
	        */
	        rachel_custom_query($popular_posts_args, $template);
	        ?>

	    </div>

	    <?php
    }
endif;


if ( ! function_exists( 'rachel_popular_carousel' ) ) :
	/**
	 * Shows a grid of featured posts with thumbnail.
	 * 
	 * @param $ppp: Number of posts to show
	 * @param $col: Number of columns
	 * @param $template: Content template to use
	 * @param: $cat: Category
	 * @param $carousel: option to make it a carousel
	 */
	function rachel_popular_carousel($template, $ppp, $cat, $col, $carousel) {

		$popular_posts_args = array(
		    'posts_per_page' => $ppp,
		    'meta_key' => 'rachel_post_viewed',
		    'orderby' => 'meta_value_num',
		    'order'=> 'DESC',
		    'category_name' => $cat
		);
		?>

		
		<div <?php if($carousel) : ?> data-slick='{"slidesToShow": <?php echo $col ?> , "slidesToScroll": 1}' <?php endif; ?> class="<?php echo ($carousel) ? 'post-carousel' : 'featured-row col-' . $col ?> featured">
      
	        <?php
	        /* 
	        * Invoke a custom WP-query
	        */
	        rachel_custom_query($popular_posts_args, $template);
	        ?>

	    </div>

	    <?php
    }
endif;



if ( ! function_exists( 'rachel_featured_post' ) ) :
	/**
	 * Shows a number of featured posts with thumbnail in a post.
	 * 
	 * @param $id: Post ID of post to show
	 * @param $template: Content template to use
	 */
	function rachel_featured_post($template, $id) {

		$featured_args = array('post_type' => 'post', 'posts_per_page' => 1, 'p' => $id); //WP Query for Featured Posts on top 
		?>

		<div class="featured-post">
      
	        <?php
	        /* 
	        * Invoke a custom WP-query
	        */
	        rachel_custom_query($featured_args, $template);
	        ?>

	    </div>

	    <?php
    }
endif;