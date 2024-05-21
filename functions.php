<?php
/**
 * Hey Rachel Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package rachel_Theme
 */

appsero_init_tracker_hey_rachel();
/**
 * Initialize Appsero
 *
 * @return void
 */
function appsero_init_tracker_hey_rachel() {

	if ( ! class_exists( 'Appsero\Client' ) ) {
	  require_once __DIR__ . '/appsero/src/Client.php';
	}

	$client = new Appsero\Client( '48bb7064-8cb7-4e19-95aa-81ed39cceea9', 'Hey Rachel', __FILE__ );

	// Active insights
	$client->insights()->init();

	// Active automatic updater
	$client->updater();

	// Active license page and checker
	$args = array(
		'type'        => 'submenu',
		'menu_title'  => __( 'Theme License', 'rachel' ),
		'page_title'  => __( 'Hey Rachel Settings', 'rachel' ),
		'menu_slug'   => 'hey_rachel_settings',
		'parent_slug' => 'themes.php'
	);
	$client->license()->add_settings_page( $args );

}

/*
* Launch the Fox framework.
*/
require_once( get_template_directory() . '/lib/fox.php' );
new Fox();


if ( ! function_exists( 'rachel_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function rachel_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Boutique Starter Theme, use a find and replace
		 * to change 'rachel' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'rachel', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary-menu' => esc_html__( 'Top Bar Menu', 'rachel' ),
			'secondary-menu' => esc_html__( 'Main Menu', 'rachel' ),
			// 'insta-links' => esc_html__( 'InstaLinks Page Menu', 'rachel' )
		) );

		// Register Footer Menu only if set
		$footer_layout = get_theme_mod('rachel_footer_layout', 'footer_1');
		if($footer_layout == 'footer_2' || $footer_layout == 'footer_3') {
			register_nav_menus( array(
				'footer-menu' => esc_html__( 'Footer Menu', 'rachel' )
			) );
		}

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'rachel_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );


		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );


		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );


		/**
		 * Add support for custom images sizes.
		 */
		add_image_size( 'featured-fullwidth', 9999, 650, true );
		add_image_size( 'featured-xl', 1400, 700, true );
		add_image_size( 'featured-large', 1280, 800, true );
		add_image_size( 'featured-small', 700, 700, true );
		add_image_size( 'featured-small-landscape', 1050, 700, true );
		add_image_size( 'featured-scaled', 700, 0, false );

		// Remove the default sizes that are not needed
		remove_image_size( 'medium' );
		remove_image_size( 'medium_large' );
		remove_image_size( 'large' );

		/*
		* Add support for post formats
		*/
		// add_theme_support( 'post-formats', array( 'gallery', 'image', 'quote', 'status', 'video', 'audio' ) );

		/*
		* Add Theme Support calls from the Fox Framework.
		*/
		// Popular Posts: rachel_popular_posts()
		add_theme_support('popular-posts');

		// Featured Posts in a row: rachel_featured_row()
		add_theme_support('featured-row-posts');

		// Featured Posts in slick slider: rachel_post_slider()
		add_theme_support('featured-slick-slider');

		// Ajax Category Index: rachel_ajax_categories()
		add_theme_support('ajax-categories');

		// Youtube Recent Videos Widget
		add_theme_support('youtube-widget');

		// Profile Widget
		add_theme_support('profile-widget');

		// Posts Widget
		add_theme_support('posts-widget');

		// Thumbnails Widget
		add_theme_support('thumbnails-widget');

		// Category Index Widget
		add_theme_support('category-index-widget');

		// Social Media Widget
		add_theme_support('social-media-widget');

		// Featured Post Widget
		add_theme_support('featured-post-widget');


		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
		 */
		add_editor_style( 'assets/css/editor-styles.css' );

		// Woocommerce Support
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
endif;
add_action( 'after_setup_theme', 'rachel_setup', 5 );

// add post-formats to post_type 'post'
add_action('init', 'rachel_add_post_formats_to_page', 11);

function rachel_add_post_formats_to_page(){
    add_post_type_support( 'post', 'post-formats' );
    register_taxonomy_for_object_type( 'post_format', 'post' );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rachel_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'rachel_content_width', 640 );
}
add_action( 'after_setup_theme', 'rachel_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rachel_widgets_init() {
	if(get_theme_mod('rachel_featured_layout', 'slider_fullwidth') == 'slider_left_featured') {

		// Top featured area
		register_sidebar( array(
			'name'          => esc_html__( 'Top Featured Area', 'rachel' ),
			'id'            => 'top-featured-area',
			'description'   => esc_html__( 'Insert Widgets next to the featured slider.', 'rachel' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>'
		) );

	}

	register_sidebar( array(
		'name'          => esc_html__( 'Blog Page Before Content', 'rachel' ),
		'id'            => 'before-content-home',
		'description'   => esc_html__( 'Widget Area before main content that shows only on the homepage.', 'rachel' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>'
	) );


	register_sidebar( array(
		'name'          => esc_html__( 'Blog Page After Content', 'rachel' ),
		'id'            => 'after-content-home',
		'description'   => esc_html__( 'Widget Area after main content that shows only on the homepage.', 'rachel' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>'
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'rachel' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'rachel' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Instagram Area', 'rachel' ),
		'id'            => 'before-footer',
		'description'   => esc_html__( 'The widget area to add an Instagram feed right above the footer.', 'rachel' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>'
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Post/Page After Content', 'rachel' ),
		'id'            => 'single-post-widgets',
		'description'   => esc_html__( 'Insert Widgets specifially after single posts and pages, right before the footer.', 'rachel' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>'
	) );

	if(get_theme_mod('rachel_footer_layout', 'footer_1') == 'footer_1') {

		// Footer area 1
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Area 1', 'rachel' ),
			'id'            => 'footer-area-1',
			'description'   => esc_html__( 'Insert Widgets in the footer.', 'rachel' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>'
		) );

		// Footer area 2
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Area 2', 'rachel' ),
			'id'            => 'footer-area-2',
			'description'   => esc_html__( 'Insert Widgets in the footer.', 'rachel' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>'
		) );

		// Footer area 3
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Area 3', 'rachel' ),
			'id'            => 'footer-area-3',
			'description'   => esc_html__( 'Insert Widgets in the footer.', 'rachel' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>'
		) );

	}

}
add_action( 'widgets_init', 'rachel_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function rachel_scripts() {
	wp_enqueue_style( 'love-rachel-style', get_stylesheet_uri() );
	// Enqueue customizer color css
	$custom_css = rachel_get_customizer_css();
  	wp_add_inline_style( 'love-rachel-style', $custom_css );

  	wp_enqueue_script( 'masonry' );

	//Enqueue custom minified and concatenated js
	wp_enqueue_script( 'love-rachel-custom-slick-min', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '', true );

	wp_enqueue_script( 'love-rachel-custom', get_template_directory_uri() . '/js/custom.min.js', array('jquery'), '', true );

	wp_enqueue_style( 'love-rachel-slick-style', get_template_directory_uri() . '/assets/css/slick.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'rachel_scripts' );


// Admin CSS
function rachel_admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri() . '/assets/css/admin.css');

  wp_enqueue_script(
		  'love-rachel-customizer-js',			//Give the script an ID
		  get_template_directory_uri() . '/assets/js/customizer/customizer.js',//Point to file
		  array( 'jquery','customize-preview' ),	//Define dependencies
		  '',						//Define a version (optional)
		  true						//Put script in footer?
	);
}
add_action('admin_enqueue_scripts', 'rachel_admin_style');


/**
 * Load Gutenberg stylesheet.
 */
function rachel_add_gutenberg_assets() {
	// Load the theme styles within Gutenberg.
	wp_enqueue_style( 'love-rachel-gutenberg', get_template_directory_uri() . '/assets/css/gutenberg-editor-style.css' );
}
add_action( 'enqueue_block_editor_assets', 'rachel_add_gutenberg_assets' );


// Customizer Preview JS
function rachel_customizer_live_preview() {
	wp_enqueue_script(
		  'love-rachel-customizer',			//Give the script an ID
		  get_template_directory_uri() . '/assets/js/customizer/customizer.js',//Point to file
		  array( 'jquery','customize-preview' ),	//Define dependencies
		  '',						//Define a version (optional)
		  true						//Put script in footer?
	);
}
add_action( 'customize_preview_init', 'rachel_customizer_live_preview', 30 );


/**
* Change the Archive Title
*/
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>' ;
    }
    return $title;
});


/*
* Helper Function: Get Color Brightness
*/
function rachel_get_brightness($hex) {

	// strip off any leading #
	$hex = str_replace('#', '', $hex);

	$c_r = hexdec(substr($hex, 0, 2));
	$c_g = hexdec(substr($hex, 2, 2));
	$c_b = hexdec(substr($hex, 4, 2));

	return (($c_r * 299) + ($c_g * 587) + ($c_b * 114)) / 1000;

}


/*
* Generate the color scheme from the Customizer
*/
function rachel_get_customizer_css() {
    ob_start();

    $base_color = get_theme_mod( 'base_color', '#FFE1DE' );
    $accent_color = get_theme_mod( 'accent_color', '#222222' );


	// Calculate brightness of the background to set font color accordingly
	if (rachel_get_brightness($base_color) > 130) {
	 $font_base_color = '#222222';
	}
	else {
	 $font_base_color = '#ffffff';
	}

	if (rachel_get_brightness($accent_color) > 130) {
	 $font_accent_color = '#222222';
	}
	else {
	 $font_accent_color = '#ffffff';
	}
	?>

	/* Base Colour Background */
	.base-color-bg, .main-navigation .menu .sub-menu, #site-navigation, footer.site-footer, .widget_yikes_easy_mc_widget, #mobile-navigation, #mobile-navigation.sticky, #mobile-navigation .mobile-menu-container, .popup-search, .widget.fullwidth, .top-slider.slider-overlay article.slick-slide .entry-header {
		background-color: <?php echo sanitize_hex_color($base_color); ?>;
		color: <?php echo sanitize_hex_color($font_base_color); ?>;
	}

	.sub-menu a, .footer-info, .site-info a, .footer-container.big-menu .social-media-icons a, footer .menu li a, .footer-container.big-menu .footer-widgets .widgettitle, .footer-container.big-menu .footer-widgets .widget-title, .main-navigation .menu-container a, #site-navigation .menu a, #site-navigation .social-media-icons a, .main-navigation .social-search-container .cart-contents, .footer-container.big-menu .site-info, #mobile-navigation .cart-contents, .main-navigation .menu-toggle, .main-navigation .close.icon-delete, .popup-search h2, #secondary .about-widget.fullwidth .about-content .about-text, .footer-widgets .about-widget .about-content .about-text, #secondary .widget_yikes_easy_mc_widget .widget-title, .top-slider.slider-overlay article.slick-slide .entry-header .entry-title a, .top-slider.slider-overlay article.slick-slide .entry-header .entry-meta a, .top-slider.slider-overlay article.slick-slide .entry-header .entry-meta, .top-slider.slider-overlay article.slick-slide .entry-header .readmore, #secondary .about-widget.fullwidth .about-content .widget-title, .footer-widgets .about-widget .about-content .widget-title, #secondary .about-widget .about-content a, .footer-widgets .about-widget .about-content a, #secondary .widget.fullwidth .widget-title, #secondary .widget.fullwidth .widgettitle, #secondary .widget.fullwidth.widget_categories li a {
		color: <?php echo sanitize_hex_color($font_base_color); ?>!important;
	}

	#secondary .widget.fullwidth.widget_categories li {
		border-color: <?php echo sanitize_hex_color($font_base_color); ?>
	}

	#mobile-navigation .menu li a, #mobile-navigation .social-media-icons a, .widget_yikes_easy_mc_widget .widgettitle, .widget_yikes_easy_mc_widget .widget-title, .widget:not(.null-instagram-feed) ul li a, .widget:not(.wp-my-instagram) ul li a {
		color: <?php echo sanitize_hex_color($font_base_color); ?>;
	}

	.woocommerce .button, .widget:not(.null-instagram-feed) ul li, .widget:not(.wp-my-instagram) ul li {
		background-color: <?php echo sanitize_hex_color($base_color); ?>!important;
		color: <?php echo sanitize_hex_color($font_base_color); ?>!important;
	}

	.shop-the-post-widget {
		border-color: <?php echo sanitize_hex_color($base_color); ?>
	}

	/* Accent Color */
	.woocommerce-store-notice, p.demo_store, .woocommerce .woocommerce-store-notice, .woocommerce-page .woocommerce-store-notice, input[type="submit"], .woocommerce #primary .entry-header {
		background-color: <?php echo sanitize_hex_color($accent_color); ?>;
		color: <?php echo sanitize_hex_color($font_accent_color); ?>;
	}

	.woocommerce-page #primary .entry-header,.woocommerce #payment #place_order, .woocommerce-page #payment #place_order, #secondary .about-widget .about-content a:hover, .footer-widgets .about-widget .about-content a:hover, .about-widget .about-content a:hover, button:hover, #secondary .about-widget .about-content a, .about-widget .about-content a {
		background-color: <?php echo sanitize_hex_color($accent_color); ?>!important;
		color: <?php echo sanitize_hex_color($font_accent_color); ?>!important;
	}

	#category-filter button:hover {
		background-color: transparent!important;
	}

	.woocommerce #primary .entry-header, .woocommerce-page #primary .entry-header .entry-title, #secondary .widget.fullwidth.widget_categories li:hover a {
		color: <?php echo sanitize_hex_color($font_accent_color); ?>!important;
	}

	.entry-content a:hover, .social-media-icons a:hover, .share a:hover, .nav-links a:hover, .category-thumbnails #category-filter button.btn.selected, .category-thumbnails #category-filter button.btn:hover, .category-posts article .posted-on a, .centered-slider article.slick-slide .entry-header .entry-meta a:hover, .centered-slider article.slick-slide .entry-header .entry-title a:hover, .top-slider article.slick-slide .entry-header .entry-meta a:hover, .top-slider article.slick-slide .entry-header .entry-title a:hover, .entry-meta a:hover, .youtube-gallery .youtube-thumb::after, blockquote::before, .wp-block-quote::before, .main-navigation .menu-container a:hover, .main-navigation .menu a:hover, .thumbnails-row .thumbnail span:hover, .thumbnails-row .thumbnail a:hover,.popular-posts .entry-meta a, .featured-row .entry-meta a, .site-header a .first, #primary.static-homepage p a  {
		color: <?php echo sanitize_hex_color($accent_color); ?>!important;
	}

	.centered-slider .slick-dots li.slick-active, .top-slider .slick-dots li.slick-active, .category-thumbnails #category-filter button.btn::before, .category-thumbnails #category-filter button.btn::after, .about-widget .widget-content .about-image .bg, .widget:not(.null-instagram-feed) ul li:hover, .widget:not(.wp-my-instagram) ul li:hover, button:not(.menu-toggle), input[type="button"], input[type="reset"], input[type="submit"]  {
		background-color: <?php echo sanitize_hex_color($accent_color); ?>!important;
	}

	.centered-slider .slick-dots li, .top-slider .slick-dots li, .shop-the-post-widget h3, .page-template-page-shop .site-main .shopping-menu h4, .page-template-default .entry-content a, .page-template-default .entry-content a:hover, .centered-slider article.slick-slide .entry-header .entry-meta .cat-links, .top-slider article.slick-slide .entry-header .entry-meta .cat-links, #related-posts h3.related-title span, #secondary .widget-title, #secondary .widgettitle, .single-post .entry-content a {
		border-color: <?php echo sanitize_hex_color($accent_color); ?>
	}

	.about-widget.fullwidth .widget-content .about-image .bg, .woocommerce span.onsale, button, input[type="button"], input[type="reset"], input[type="submit"], #secondary .about-widget .about-content a  {
		background-color: <?php echo sanitize_hex_color($accent_color); ?>;
		color: <?php echo sanitize_hex_color($font_accent_color); ?>;
	}

	.widget:not(.null-instagram-feed) ul li:hover a, .widget:not(.wp-my-instagram) ul li:hover a {
		color: <?php echo sanitize_hex_color($font_accent_color); ?>;
	}


    <?php
    $css = ob_get_clean();
    return $css;
}


/**
 * Show cart contents / total Ajax
 */
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'rachel'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'rachel'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );



// Workaround Merlin
add_action('init', 'rachel_do_output_buffer');
function rachel_do_output_buffer() {
	ob_start();
}


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/lib/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/lib/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/lib/template-functions.php';

/**
 * Plugin activation of required and recommended plugins.
 */
require get_template_directory() . '/lib/plugin-activation.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/lib/customizer/customizer-custom-classes.php';
require get_template_directory() . '/lib/customizer/customizer-settings.php';

/**
 * Theme tags.
 */
require get_template_directory() . '/inc/theme-tags.php';

/*
* Merlin Onboarding.
*/
require_once get_template_directory() . '/lib/merlin/vendor/autoload.php';
require_once get_template_directory() . '/lib/merlin/class-merlin.php';
require_once get_template_directory() . '/lib/merlin-config.php';
