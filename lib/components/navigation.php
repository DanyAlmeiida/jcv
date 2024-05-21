<?php
/**
 * Different Navigations for different use cases
 *
 * @package myboutique
 */

if ( ! function_exists( 'rachel_top_sticky_navigation' ) ) :
	/**
	 * Top Sticky Navigation (different view on desktop and mobile)
	 */
	function rachel_top_sticky_navigation() {
		?>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="top-social">
				<?php mp_social_media(); ?>
			</div>
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
			<div class="top-search">
				<div class="nav-right">
					<a href="#" style="margin-top: 5px"><i class="icon-envelope"></i></a>
					<?php echo get_search_form(); ?>
				</div>
			</div>
		</nav><!-- #site-navigation -->

		<nav id="mobile-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" title="<?php esc_attr_e( 'Toggle the navigation menu', 'rachel' ) ?>"><i class="icon-menu" aria-hidden="true"></i></button> 
			<div id="mobile-menu">
				<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
				<div class="top-social">
					<?php mp_social_media(); ?>
				</div>
			</div>
			<div class="top-search">
				<div class="nav-right">
					<a href="#" style="margin-top: 5px"><i class="icon-envelope"></i></a>
					<?php echo get_search_form(); ?>
				</div>
			</div>
		</nav><!-- #mobile-navigation -->
	<?php
	}
}