<?php
/*
*
* Footer Style 1 
*
* Logo + Description left + 2 Menus right
*
*/
?>
<div class="footer-container big-menu">
			<div class="footer-info">
				<?php
				$custom_logo = get_custom_logo();

				if(has_custom_logo()) {

					echo $custom_logo;

				} else {
					
					echo '<p class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'name', 'display' ) . '</a></p>';

				}

				
				$footer_description = get_theme_mod('rachel_footer_description');

				if($footer_description != '') {

					echo '<p class="blog-description">' . $footer_description . '</p>';

				} else {
					
					echo '<p class="blog-description">' . get_bloginfo( 'description', 'display' ) . '</p>';
					
				}

				?>
				<?php rachel_social_media(); ?>
			</div>

			<div class="footer-widgets">
				<?php if(is_active_sidebar('footer-area-1')) : ?>
					<div class="footer-widget footer-widget-1">
						<?php dynamic_sidebar('footer-area-1'); ?>
					</div>
				<?php endif; ?>

				<?php if(is_active_sidebar('footer-area-2')) : ?>
					<div class="footer-widget footer-widget-2">
						<?php dynamic_sidebar('footer-area-2'); ?>
					</div>
				<?php endif; ?>

				<?php if(is_active_sidebar('footer-area-3')) : ?>
					<div class="footer-widget footer-widget-3">
						<?php dynamic_sidebar('footer-area-3'); ?>
					</div>
				<?php endif; ?>
			</div>

			<p class="site-info">
				<?php
				$footer_copyright = get_theme_mod('rachel_footer_copyright_notice');

				if($footer_copyright != '') {

					echo '<p class="copyright">' . $footer_copyright . '</p>';

				}

				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( '%1$s by %2$s.', 'rachel' ), '<a href="https://www.myboutiquethemes.com/" target="_blank">Rachel WordPress Theme</a>', 'My Boutique Themes' );
					?>
			</p><!-- .site-info -->
	</div><!-- .footer-container -->