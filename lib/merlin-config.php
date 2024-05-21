<?php
/**
 * Merlin WP configuration file.
 *
 * @package   Merlin WP
 * @version   1.0.0
 * @link      https://merlinwp.com/
 * @author    Rich Tabor, from ThemeBeans.com & the team at ProteusThemes.com
 * @copyright Copyright (c) 2018, Merlin WP of Inventionn LLC
 * @license   Licensed GPLv3 for Open Source Use
 */
if ( ! class_exists( 'Merlin' ) ) {
	return;
}
/**
 * Set directory locations, text strings, and settings.
 */
$wizard = new Merlin(
	$config = array(
		'directory'            => 'lib/merlin', // Location / directory where Merlin WP is placed in your theme.
		'merlin_url'           => 'onboarding', // The wp-admin page slug where Merlin WP loads.
		'parent_slug'          => 'themes.php', // The wp-admin parent page slug for the admin menu item.
		'capability'           => 'manage_options', // The capability required for this menu to be displayed to the user.
		'child_action_btn_url' => 'https://codex.wordpress.org/child_themes', // URL for the 'child-action-link'.
		'dev_mode'             => true, // Enable development mode for testing.
		'license_step'         => false, // EDD license activation step.
		'license_required'     => false, // Require the license activation step.
		'license_help_url'     => '', // URL for the 'license-tooltip'.
		'edd_remote_api_url'   => '', // EDD_Theme_Updater_Admin remote_api_url.
		'edd_item_name'        => '', // EDD_Theme_Updater_Admin item_name.
		'edd_theme_slug'       => '', // EDD_Theme_Updater_Admin item_slug.
		'ready_big_button_url' => '/', // Link for the big button on the ready step.
	),
	$strings = array(
		'admin-menu'               => esc_html__( 'Theme Setup', 'rachel' ),
		/* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
		'title%s%s%s%s'            => esc_html__( '%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', 'rachel' ),
		'return-to-dashboard'      => esc_html__( 'Return to the dashboard', 'rachel' ),
		'ignore'                   => esc_html__( 'Disable this wizard', 'rachel' ),
		'btn-skip'                 => esc_html__( 'Skip', 'rachel' ),
		'btn-next'                 => esc_html__( 'Next', 'rachel' ),
		'btn-start'                => esc_html__( 'Start', 'rachel' ),
		'btn-no'                   => esc_html__( 'Cancel', 'rachel' ),
		'btn-plugins-install'      => esc_html__( 'Install', 'rachel' ),
		'btn-child-install'        => esc_html__( 'Install', 'rachel' ),
		'btn-content-install'      => esc_html__( 'Install', 'rachel' ),
		'btn-import'               => esc_html__( 'Import', 'rachel' ),
		'btn-license-activate'     => esc_html__( 'Activate', 'rachel' ),
		'btn-license-skip'         => esc_html__( 'Later', 'rachel' ),
		/* translators: Theme Name */
		'license-header%s'         => esc_html__( 'Activate %s', 'rachel' ),
		/* translators: Theme Name */
		'license-header-success%s' => esc_html__( '%s is Activated', 'rachel' ),
		/* translators: Theme Name */
		'license%s'                => esc_html__( 'Enter your license key to enable remote updates and theme support.', 'rachel' ),
		'license-label'            => esc_html__( 'License key', 'rachel' ),
		'license-success%s'        => esc_html__( 'The theme is already registered, so you can go to the next step!', 'rachel' ),
		'license-json-success%s'   => esc_html__( 'Your theme is activated! Remote updates and theme support are enabled.', 'rachel' ),
		'license-tooltip'          => esc_html__( 'Need help?', 'rachel' ),
		/* translators: Theme Name */
		'welcome-header%s'         => esc_html__( 'Welcome to %s', 'rachel' ),
		'welcome-header-success%s' => esc_html__( 'Hi. Welcome back', 'rachel' ),
		'welcome%s'                => esc_html__( 'This wizard will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', 'rachel' ),
		'welcome-success%s'        => esc_html__( 'You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'rachel' ),
		'child-header'             => esc_html__( 'Install Child Theme', 'rachel' ),
		'child-header-success'     => esc_html__( 'You\'re good to go!', 'rachel' ),
		'child'                    => esc_html__( 'Let\'s build & activate a child theme so you can easily make theme changes.', 'rachel' ),
		'child-success%s'          => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'rachel' ),
		'child-action-link'        => esc_html__( 'Learn about child themes', 'rachel' ),
		'child-json-success%s'     => esc_html__( 'Awesome. Your child theme has already been installed and is now activated.', 'rachel' ),
		'child-json-already%s'     => esc_html__( 'Awesome. Your child theme has been created and is now activated.', 'rachel' ),
		'plugins-header'           => esc_html__( 'Install Plugins', 'rachel' ),
		'plugins-header-success'   => esc_html__( 'You\'re up to speed!', 'rachel' ),
		'plugins'                  => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'rachel' ),
		'plugins-success%s'        => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'rachel' ),
		'plugins-action-link'      => esc_html__( 'Advanced', 'rachel' ),
		'import-header'            => esc_html__( 'Import Content', 'rachel' ),
		'import'                   => sprintf( 'Let\'s import content to your website, to help you get familiar with the theme. See all <a href="%s">Theme Demos</a>.', 'https://demo.myboutiquethemes.com?theme=vida&demo=classic' ),
		'import-action-link'       => esc_html__( 'Choose what to import', 'rachel' ),
		'ready-header'             => esc_html__( 'All done. Have fun!', 'rachel' ),
		/* translators: Theme Author */
		'ready%s'                  => esc_html__( 'Your theme has been all set up. Enjoy your new %s.', 'rachel' ),
		'ready-action-link'        => esc_html__( 'Extras', 'rachel' ),
		'ready-big-button'         => esc_html__( 'View your website', 'rachel' ),
		'ready-link-1'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://wordpress.org/support/', esc_html__( 'Explore WordPress', 'rachel' ) ),
		'ready-link-2'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://themebeans.com/contact/', esc_html__( 'Get Theme Support', 'rachel' ) ),
		'ready-link-3'             => sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'customize.php' ), esc_html__( 'Start Customizing', 'rachel' ) ),
	)
);

function rachel_merlin_import_files() {
	// return array(
	// 	array(
	// 		'import_file_name'           => 'Rachel 01 - Peach & Greens',
	// 		'import_file_url'            => 'https://demo.myboutiquethemes.com/demos/rachel-1-content.xml',
	// 		'import_widget_file_url'     => 'https://demo.myboutiquethemes.com/demos/rachel-1-widgets.wie',
	// 		'import_customizer_file_url' => 'https://demo.myboutiquethemes.com/demos/rachel-1-customizer.dat',
	// 		'import_preview_image_url'   => 'https://demo.myboutiquethemes.com/demos/screenshot.png',
	// 		'import_notice'              => __( 'Rachel 01 - Peach & Greens', 'rachel' ),
	// 		'preview_url'                => 'https://demo.myboutiquethemes.com/rachel-1',
	// 	),
	// 	array(
	// 		'import_file_name'           => 'Rachel 02 - Nordic Blue',
	// 		'import_file_url'            => 'https://demo.myboutiquethemes.com/demos/rachel-2-content.xml',
	// 		'import_widget_file_url'     => 'https://demo.myboutiquethemes.com/demos/rachel-2-widgets.wie',
	// 		'import_customizer_file_url' => 'https://demo.myboutiquethemes.com/demos/rachel-2-customizer.dat',
	// 		'import_preview_image_url'   => 'https://demo.myboutiquethemes.com/demos/screenshot.png',
	// 		'import_notice'              => __( 'Rachel 02 - Nordic Blue', 'rachel' ),
	// 		'preview_url'                => 'https://demo.myboutiquethemes.com/rachel-2',
	// 	),
	// 	array(
	// 		'import_file_name'           => 'Rachel 03 - Pastels',
	// 		'import_file_url'            => 'https://demo.myboutiquethemes.com/demos/rachel-3-content.xml',
	// 		'import_widget_file_url'     => 'https://demo.myboutiquethemes.com/demos/rachel-3-widgets.wie',
	// 		'import_customizer_file_url' => 'https://demo.myboutiquethemes.com/demos/rachel-3-customizer.dat',
	// 		'import_preview_image_url'   => 'https://demo.myboutiquethemes.com/demos/screenshot.png',
	// 		'import_notice'              => __( 'Rachel 03 - Pastels', 'rachel' ),
	// 		'preview_url'                => 'https://demo.myboutiquethemes.com/rachel-3',
	// 	)
	// );


	return array(
		array(
			'import_file_name'             => 'Rachel 01 - Peach & Greens',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'lib/merlin/demo/rachel-1-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'lib/merlin/demo/rachel-1-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'lib/merlin/demo/rachel-1-customizer.dat',
			'import_preview_image_url'   => 'https://demo.myboutiquethemes.com/demos/screenshot.png',
			'import_notice'              => __( 'Rachel 01 - Peach & Greens', 'rachel' ),
	 		'preview_url'                => 'https://demo.myboutiquethemes.com/rachel-1',
		),
		array(
			'import_file_name'             => 'Rachel 02 - Nordic Blue',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'lib/merlin/demo/rachel-2-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'lib/merlin/demo/rachel-2-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'lib/merlin/demo/rachel-2-customizer.dat',
			'import_preview_image_url'   => 'https://demo.myboutiquethemes.com/demos/screenshot.png',
			'import_notice'              => __( 'Rachel 02 - Nordic Blue', 'rachel' ),
	 		'preview_url'                => 'https://demo.myboutiquethemes.com/rachel-2',
		),
		array(
			'import_file_name'             => 'Rachel 03 - Pastels',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'lib/merlin/demo/rachel-3-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'lib/merlin/demo/rachel-3-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'lib/merlin/demo/rachel-3-customizer.dat',
			'import_preview_image_url'   => 'https://demo.myboutiquethemes.com/demos/screenshot.png',
			'import_notice'              => __( 'Rachel 03 - Pastels', 'rachel' ),
	 		'preview_url'                => 'https://demo.myboutiquethemes.com/rachel-3',
		),
		array(
			'import_file_name'             => 'Hey Rachel',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'lib/merlin/demo/hey-rachel-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'lib/merlin/demo/hey-rachel-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'lib/merlin/demo/hey-rachel-customizer.dat',
			'import_preview_image_url'   => 'https://demo.myboutiquethemes.com/demos/screenshot.png',
			'import_notice'              => __( 'Hey Rachel', 'rachel' ),
	 		'preview_url'                => 'https://demo.myboutiquethemes.com/hey-rachel',
		),
	);
}
add_filter( 'merlin_import_files', 'rachel_merlin_import_files' );


/**
 * Add your widget area to unset the default widgets from.
 * If your theme's first widget area is "sidebar-1", you don't need this.
 *
 * @see https://stackoverflow.com/questions/11757461/how-to-populate-widgets-on-sidebar-on-theme-activation
 *
 * @param  array $widget_areas Arguments for the sidebars_widgets widget areas.
 * @return array of arguments to update the sidebars_widgets option.
 */
function rachel_merlin_unset_default_widgets_args( $widget_areas ) {
	$widget_areas = array(
		'sidebar-1' => array(),
	);
	return $widget_areas;
}
add_filter( 'merlin_unset_default_widgets_args', 'rachel_merlin_unset_default_widgets_args' );


/**
 * Execute custom code after the whole import has finished.
 */
function rachel_merlin_after_import_setup() {
	// Import Elementor templates to "My templates" library
	// if(in_array('elementor/elementor.php', apply_filters('active_plugins', get_option('active_plugins')))) { 
	    
	//     rachel_import_template( __DIR__ . '/../../assets/templates/test.json' );

	// }

	// Assign menus to their locations.
	$main_menu = get_term_by( 'name', 'Top Bar Menu', 'nav_menu' );
	$side_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
	$footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
	//$insta_menu = get_term_by( 'name', 'InstaLinks Page Menu', 'nav_menu' );
	set_theme_mod(
		'nav_menu_locations', array(
			'primary-menu' => $main_menu->term_id,
			'secondary-menu' => $side_menu->term_id,
			'footer-menu' => $footer_menu->term_id,
			//'insta-links' => $insta_menu->term_id
		)
	);

	// Delete the Sample Content
    $defaultPage = get_page_by_title( 'Sample Page' );
    wp_delete_post( $defaultPage->ID, $bypass_trash = true );

    $defaultPost = get_posts( array( 'title' => 'Hello World!' ) );
    wp_delete_post( $defaultPost[0]->ID, $bypass_trash = true );
    $defaultPost1 = get_posts( array( 'title' => 'Hello world!' ) );
    wp_delete_post( $defaultPost1[0]->ID, $bypass_trash = true );

    // Set static homepage
    $home = get_page_by_title( 'Home' );
	update_option( 'page_on_front', $home->ID );
	update_option( 'show_on_front', 'page' );

	// Set the blog page
	$blog = get_page_by_title( 'Blog' );
	update_option( 'page_for_posts', $blog->ID );

	// Set option to disable default Elementor colors/fonts
	update_option( 'elementor_disable_color_schemes', 'yes');
	update_option( 'elementor_disable_typography_schemes', 'yes');

}
add_action( 'merlin_after_all_import', 'rachel_merlin_after_import_setup' );


/*
* Helper function to import elementor templates from json
*/
function rachel_import_template( $file ) {  
    $fileContent = file_get_contents( $file );  
    \Elementor\Plugin::instance()->templates_manager->import_template( [  
        'fileData' => base64_encode( $fileContent ),  
        'fileName' => 'test.json',  
    ]);  
}