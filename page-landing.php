<?php
/**
 * Template Name: Landing Page
 *
 * The template for displaying a simple landing page
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package My_Boutique_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area landing-page">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();

				the_content();

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

</div>
<?php

get_footer();
