<nav id="mobile-navigation" class="main-navigation <?php echo (get_theme_mod('rachel_stickynav_checkbox', false) == true) ? 'sticky' : ''?>">
	<button class="menu-toggle slide-down" aria-controls="main-navigation" aria-expanded="false"><i class="icon-menu"></i><span><?php echo __('Menu', 'rachel') ?></span></button>
	<div>
	<i class="icon-search-bold search-icon"></i>
	<?php
	//Woocommerce Icon
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		 
		    $count = WC()->cart->cart_contents_count;
		   	?>
		   	<a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'rachel' ); ?>">

		        <span class="cart-contents"><i class="icon-shopping-bag"></i> <?php echo esc_html( $count ); ?></span>
		    </a>
		 
		<?php } ?>
	</div>
	<div class="mobile-menu-container">
		<?php
		if ( has_nav_menu( 'primary-menu' ) ) : 
			wp_nav_menu( array(
				'theme_location' => 'primary-menu',
				'menu_id'        => 'primary-menu',
			) );
		endif;		
		?>
		<?php
		if ( has_nav_menu( 'secondary-menu' ) ) :
			wp_nav_menu( array(
				'theme_location' => 'secondary-menu',
				'menu_id'        => 'secondary-menu',
			) );
		endif;		
		?>
		<?php rachel_social_media(); ?>
	</div>
</nav>