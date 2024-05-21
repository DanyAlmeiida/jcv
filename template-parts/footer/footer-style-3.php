<?php
/*
*
* Footer Style 3
*
* Big Logo + Menu
*
*/
?>
<div class="footer-container big-logo">

	<div class="footer-logo">
		<?php
				$custom_logo = get_custom_logo();

				if($custom_logo != '') {

					echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . $custom_logo . '</a>';

				} else {
					
					echo '<p class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'name', 'display' ) . '</a></p>';

				}
		?>
	</div>

	<div class="footer-menu">
		<?php wp_nav_menu( array(
			'theme_location' => 'footer-menu',
			'menu_id'        => 'footer-menu',
			) ); ?>
	</div>

	<div class="footer-info">
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
	</div>
			
</div><!-- .footer-container -->