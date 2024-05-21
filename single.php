<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package My_Boutique_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content/content', get_post_type() );

			rachel_posts_navigation();

			// Related Posts
			if( get_theme_mod('rachel_related_checkbox', true) == true) {
				if ( get_theme_mod('rachel_related_type', 'categories') == 'categories' ) {
					rachel_related_posts_categories();
				}
				else {
					rachel_related_posts_tags();
				}
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php 
	
	if(get_theme_mod('rachel_articlesidebar_checkbox', TRUE) == TRUE) {
		get_sidebar();
	} else {
		echo '</div>';
	}

	// Single Post and Page Widget
	?>
	<div id="after-single-post" class="widget-area single-post-widgets">
		<?php dynamic_sidebar( 'single-post-widgets' ); ?>
	</div><!-- #after-single-post -->

<?php
rachel_next_post_slider();


get_footer();
