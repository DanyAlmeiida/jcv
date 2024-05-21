<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package My_Boutique_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'rachel' ); ?></a>


	<!-- Check if Landing Page -->
	<?php if(!is_page_template('page-landing.php')) : ?>

		<?php
		if(!is_page_template('page-instalinks.php')) {
			get_template_part( 'template-parts/header/header', 'style-1' ); 
		} else {
			get_template_part( 'template-parts/header/site', 'title' );
		}

	

	if(is_home()) {

		// Don't use the slider feature in this theme
		// $featured_layout = get_theme_mod('rachel_featured_layout', 'slider-fullwidth');
		// $number_posts = get_theme_mod('rachel_featured_number', 4);
		
		// if($featured_layout == 'slider_fullwidth') {
		// 	rachel_post_slider($number_posts, 'slider-fullwidth');
		// } else if($featured_layout == 'slider_overlay') {
		// 	rachel_post_slider($number_posts, 'featured');
		// } else if($featured_layout == 'slider_contentwidth') {
		// 	rachel_post_slider($number_posts, 'slider-xl');
		// }else if($featured_layout == 'slider_contentwidth') {
		// 	rachel_post_slider($number_posts, 'slider-xl');
		// } else if($featured_layout == 'slider_centered') {
		// 	rachel_centered_slider($number_posts, 'featured');
		// } else if($featured_layout == 'slider_left_featured') {
			?>
			<!--<div class="featured-slider-widget small-width">
				<?php //rachel_post_slider($number_posts, 'featured'); ?>
				<div class="top-featured-area"> <?php //dynamic_sidebar( 'top-featured-area' ); ?></div>
			</div> -->
			<?php
		//}

		?>
		<?php if(is_active_sidebar('before-content-home')): ?>
			<div id="before-content-home" class="widget-area before-content-home">
				<?php dynamic_sidebar( 'before-content-home' ); ?>
			</div> <!-- #before-content-home -->
		<?php endif; ?>
	<?php 
	}

	// Check for sidebar settings
	if(is_single()) {

		$sidebar = (get_theme_mod('rachel_articlesidebar_checkbox', TRUE) == true) ? true : false;

	} else if(is_page() && !(is_page_template('page-instalinks.php'))) {

		$sidebar = (get_theme_mod('rachel_pagesidebar_checkbox', TRUE) == true) ? true : false;

	} else if(is_home()) {

		$sidebar = (get_theme_mod('rachel_show_sidebar_blog', 'sidebar') == 'sidebar') ? true : false;
		
	} else {

		$sidebar = false;
		
	}

	$sidebar_class = ($sidebar) ? 'has-sidebar' : '';
	?>

	<?php
	if (  is_front_page() && !is_home() ) : ?>
		<div id="content" class="site-content">

	<?php
	else : ?>
		<div id="content" class="site-content small-width <?php echo $sidebar_class ?>">

	<?php
	endif;


	else: ?>

	<div id="content" class="site-content small-width">

	<?php endif; ?>
