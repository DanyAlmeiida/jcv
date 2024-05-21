<?php

/*
* Enqueue necessary scripts.
*/
function enqueue_genre_ajax_scripts() {
    wp_localize_script( 'love-rachel-custom', 'ajaxpagination', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	));
}
add_action('wp_enqueue_scripts', 'enqueue_genre_ajax_scripts');


/* 
* AJAX Loading for Category Posts on Homepage
*/
add_action('wp_ajax_nopriv_rachel_category_post_ajax', 'rachel_load_ajax_category');
add_action('wp_ajax_rachel_category_post_ajax', 'rachel_load_ajax_category');
 
if (!function_exists('rachel_load_ajax_category')) {
	function rachel_load_ajax_category() { 
 
	    $cat = (isset($_POST['cat'])) ? $_POST['cat'] : 0;
	    $ppp = (isset($_POST['ppp'])) ? $_POST['ppp'] : 4;
	    $cols = (isset($_POST['cols'])) ? $_POST['cols'] : 4;
	    $template = (isset($_POST['template'])) ? $_POST['template'] : 'featured-small';
 
	    rachel_featured_grid($template, $ppp, get_cat_name($cat), $cols);

	}
}


if ( ! function_exists( 'rachel_ajax_categories' ) ) :
	/**
	 * Shows posts from different categories by ajax
	 * 
	 * @param $ppp: Posts per page
	 * @param $template: Content template to use
	 */
	function rachel_ajax_categories($template, $ppp, $cols, $categories) {

		?>
		<div class="category-thumbnails" data-columns="<?php echo $cols ?>" data-posts="<?php echo $ppp ?>" data-template="<?php echo $template ?>">
			<div id="category-filter">
				<?php 
				$i = 0;
				foreach($categories as $cat) : ?>

					<?php if($i == 0) {
						if($cat == -1) : ?>
		        		<button class="btn selected" data-category="<?php echo $cat ?>" data-catname="<?php _e('All Categories', 'rachel'); ?>"><?php _e('All Categories', 'rachel'); ?></button>
			        	<?php else : ?>
			        		<button class="btn selected" data-category="<?php echo $cat ?>" data-catname="<?php echo get_cat_name($cat) ?>"><?php echo get_cat_name($cat) ?></button>
			        	<?php endif;
					} else {
						if($cat == -1) : ?>
			        		<button class="btn" data-category="<?php echo $cat ?>" data-catname="<?php _e('All Categories', 'rachel'); ?>"><?php _e('All Categories', 'rachel'); ?></button>
			        	<?php else : ?>
			        		<button class="btn" data-category="<?php echo $cat ?>" data-catname="<?php echo get_cat_name($cat) ?>"><?php echo get_cat_name($cat) ?></button>
			        	<?php endif;
					}
				
				$i++;
				endforeach; ?>
			</div>
			

			<h3 class="ajax-cat-name"><?php echo get_cat_name($categories[0]) ?></h3>
			
			<div class="category-posts">
			<?php  
				rachel_featured_grid($template, $ppp, get_cat_name($categories[0]), $cols);
			?>

			</div>
		</div>
	<?php
	}
endif;
