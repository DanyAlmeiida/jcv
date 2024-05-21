<?php
/**
 * Template part for Navigation/Header Style 2
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package My_Boutique_Theme
 */
?>

<?php rachel_popup_search(); ?>

<!-- Mobile Navigation -->
<?php get_template_part( 'template-parts/header/mobile', 'nav' ); ?>

<div class="header-container <?php echo (get_theme_mod('rachel_stickynav_checkbox', false) == true) ? 'sticky' : ''?>">
	
	<!-- Left Navigation Menu -->
	<nav id="left-navigation" class="main-navigation left-navigation">
		<div class="menu-container">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary-menu',
				'menu_id'        => 'primary-menu',
			) );		
			?>
		</div>
	</nav>

	<!-- Site Header -->
	<?php get_template_part( 'template-parts/header/site', 'title' ); ?>

	<!-- Right Navigation Menu -->
	<nav id="right-navigation" class="main-navigation right-navigation">
		<div class="menu-container">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'secondary-menu',
				'menu_id'        => 'secondary-menu',
			) );		
			?>
		</div>
		<div class="social-search-container">
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
	</nav>
</div>
