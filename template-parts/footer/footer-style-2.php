<?php
/*
*
* Footer Style 2
*
* Minimal Menu + Copyright
*
*/
?>
<div class="footer-container minimal-menu">

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