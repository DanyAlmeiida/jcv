<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
