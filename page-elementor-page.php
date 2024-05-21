<?php
/**
 * The main template file
 *
 * Template Name: Elementor Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package My_Boutique_Theme
 */

get_header(); 

?>

	<div id="primary" class="content-area static-homepage">

		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				the_content();
				
			endwhile;

		else :

			the_content();

		endif; ?>

		</main><!-- #main -->


	</div><!-- #primary -->

	<?php 

	// Close the primary/secondary container on fullwidth pages
	if(!is_single()) {
		echo '</div>';
	}

get_footer();
