<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package My_Boutique_Theme
 */

get_header(); ?>

	<?php woocommerce_breadcrumb(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php woocommerce_content(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

</div>
<?php

get_footer();
