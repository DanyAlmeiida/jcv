<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package My_Boutique_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header><!-- .page-header -->

		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>


			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content/content', 'home-small' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	// Close the primary/secondary container on fullwidth pages
	if(!is_home() || !is_single()) {
		echo '</div>';
	}


get_footer();
