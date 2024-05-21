<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package My_Boutique_Theme
 */

?>
	<?php if(!is_page_template('page-landing.php')) : ?>
		<div id="before-footer" class="widget-area before-footer">
			<?php dynamic_sidebar( 'before-footer' ); ?> 
		</div>

		<footer id="colophon" class="site-footer base-color-bg">
			<?php 
			$footer_layout = get_theme_mod('rachel_footer_layout', 'footer_1');

			if($footer_layout == 'footer_2') {
				get_template_part('template-parts/footer/footer', 'style-2'); 
			} else if($footer_layout == 'footer_3') {
				get_template_part('template-parts/footer/footer', 'style-3'); 
			} else {
				get_template_part('template-parts/footer/footer', 'style-1'); 
			}	
		?>
		</footer><!-- #colophon -->
	<?php endif;?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
