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

$sidebar = (get_theme_mod('rachel_show_sidebar_blog', 'sidebar') == 'sidebar') ? true : false;

$post_layout = get_theme_mod('rachel_posts_layout', 'normal');
?>

	<div id="primary" class="content-area">
		<?php
		if (  is_front_page() && !is_home() ) : ?>
			<main id="main" class="site-main">

		<?php
		else : ?>
			<main id="main" class="site-main <?php echo ($post_layout == 'side_magazine') ? 'side-magazine' : '' ?> <?php echo ($post_layout == 'alternating') ? 'side-magazine alternating' : '' ?>">

		<?php
		endif;
		?>
		

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			$i = 0;


			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */

				if($post_layout == 'featured_magazine') {

					// Style 2: Big - small small - small small ...
					if($i == 0) {
						get_template_part( 'template-parts/content/content', 'home' );
					} else {
						get_template_part( 'template-parts/content/content', 'home-small' );
					}

				} else if($post_layout == 'normal') {

					// Style 3: Big - Big - Big ... (centered)
					get_template_part( 'template-parts/content/content', 'home' );

				}  else if($post_layout == 'alternating' || $post_layout == 'side_magazine') {

						get_template_part( 'template-parts/content/content', 'side' );
					
				} else if($post_layout == 'complex_magazine') {

					// Style 1: Big - small small - big - small small - big ...
					if($i % 3 == 0) {
						get_template_part( 'template-parts/content/content', 'home' );
					} else {
						get_template_part( 'template-parts/content/content', 'home-small' );
					}

				} else {

					// Style 5: Bsmall small - small small ...
					get_template_part( 'template-parts/content/content', 'home-small' );

				}

				$i++;

			endwhile;

			// Older and newer posts
			rachel_numeric_posts_nav();

		else :

			get_template_part( 'template-parts/content/content', 'none' );

		endif; ?>

		</main><!-- #main -->


	</div><!-- #primary -->

	<?php 

	if($sidebar) {
		get_sidebar();
	}
	

	// Close the primary/secondary container on fullwidth pages
	if(!is_single()) {
		echo '</div>';
	}

	
	if(is_home()) { ?>
		<div id="after-content-home" class="widget-area after-content-home">
			<?php dynamic_sidebar( 'after-content-home' ); ?>
		</div><!-- #after-content-home -->
	<?php }
	?>

<?php
get_footer();
