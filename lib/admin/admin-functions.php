<?php
/**
 * vida Admin Functionality
 *
 * @package vida
 */

// function rachel_theme_docs_admin_notice(){
//     global $pagenow;
//     if ( $pagenow == 'themes.php' ) {
//          echo '<div class="notice notice-success is-dismissible">
//              <p>Welcome to your new <strong>My Boutique Theme</strong>. Please have a look at our <a href="#">Theme Documentation</a> for theme setup and customization.</p>
//          </div>';
//     }
// }
// add_action('admin_notices', 'rachel_theme_docs_admin_notice');


// Create the theme's admin page
function rachel_my_admin_menu() {
	$parent_theme = wp_get_theme(get_template());
	$parent_theme_name = $parent_theme->get( 'Name' );

	add_menu_page( 'Welcome to ' . $parent_theme_name . ', your new Theme', $parent_theme_name . ' Theme', 'manage_options', $parent_theme_name . '_admin_page', 'myb_admin_page', 'dashicons-laptop', 3  );

}
add_action( 'admin_menu', 'rachel_my_admin_menu' );


// Display Theme Admin Page 
function myb_admin_page() {
	$theme = wp_get_theme(get_template());
	$theme_name = $theme->get( 'Name' );

	?>
	<div class="theme-page">
		<img class="logo" src="http://demo.myboutiquethemes.com/wp-content/uploads/2019/04/logo_rose.png" alt="myb Logo">
		<h2>Welcome To <?php echo $theme_name ?>, your new WordPress Theme</h2>
		<p>by <em>My Boutique Themes</em></p>

		<div class="start">
			<p><?php _e('To start, we have prepared an extensive theme documentation that will guide you through the process of setting up your theme (just like in the demo version).', 'rachel'); ?></p>
			<button class="highlight big"><a href="https://docs.myboutiquethemes.com" target="_blank"><?php echo $theme_name . __(' Theme Documentation', 'rachel'); ?></a></button>
		</div>

		<hr/>

		<div class="more">
			<p><?php _e('If you need more help or information about your new theme, have a look at our demo sites or (re-)start the theme\'s setup wizard to customize your site in no time.', 'rachel'); ?></p>
			<div class="buttons-container">
				<button><a href="<?php echo admin_url('themes.php?page=onboarding') ?>"><?php _e('Start Setup Wizard', 'rachel'); ?></a></button>
				<button><a href="https://demo.myboutiquethemes.com?theme=vida&demo=classic" target="_blank"><?php _e('Demo Sites', 'rachel'); ?></a></button>
			</div>
		</div>

	</div>
	<?php
}