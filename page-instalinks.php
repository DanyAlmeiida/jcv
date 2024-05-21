<?php
/**
 *
 * Template Name: Instalinks
 *
 * The template for displaying the insta links
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package My_Boutique_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<?php
				// wp_nav_menu( array(
				// 	'theme_location' => 'insta-links',
				// 	'menu_id'        => 'insta-links',
				// ) );

		the_content();

			?>
	</div><!-- #primary -->

</div>

<?php
get_footer();
