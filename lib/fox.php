<?php 
/* 
* Fox Framework for MP Studio Themes.
*
* To be used, all components first have to be added with add_theme_support in functions.php.
*
*/

if ( ! class_exists( 'Fox' ) ) {

	/**
	 * The Fox class launches the framework.  It's the organizational structure behind the
	 * entire framework.  This file should be loaded before anything else to use the framework.
	 *
	 * Theme authors should not access this class directly. Instead, use the `Fox()` function.
	 *
	 * @access public
	 */
	final class Fox {

		/**
		 * Framework directory path with trailing slash.
		 *
		 * @access public
		 * @var    string
		 */
		public $dir = '';

		/**
		 * Framework directory URI with trailing slash.
		 *
		 * @access public
		 * @var    string
		 */
		public $uri = '';

		/**
		 * Parent theme directory path with trailing slash.
		 *
		 * @access public
		 * @var    string
		 */
		public $parent_dir = '';

		/**
		 * Child theme directory path with trailing slash.
		 *
		 * @access public
		 * @var    string
		 */
		public $child_dir = '';

		/**
		 * Parent theme directory URI with trailing slash.
		 *
		 * @access public
		 * @var    string
		 */
		public $parent_uri = '';

		/**
		 * Child theme directory URI with trailing slash.
		 *
		 * @access public
		 * @var    string
		 */
		public $child_uri = '';

		/**
		 * Parent theme textdomain.
		 *
		 * @access public
		 * @var    string
		 */
		public $parent_textdomain = '';

		/**
		 * Child theme textdomain.
		 *
		 * @access public
		 * @var    string
		 */
		public $child_textdomain = '';

		/**
		 * Returns the instance.
		 *
		 * @access public
		 * @return object
		 */
		public static function get_instance() {

			static $instance = null;

			if ( is_null( $instance ) ) {
				$instance = new self;
				$instance->setup();
				$instance->core();
				$instance->setup_actions();
			}

			return $instance;
		}

		/**
		 * Constructor method.
		 *
		 * @access private
		 * @return void
		 */
		//private function __construct() {}

		/**
		 * Sets up the framework.
		 *
		 * @access private
		 * @return void
		 */
		private function setup() {

			// Theme directory paths.
			$this->parent_dir = trailingslashit( get_template_directory()   );
			$this->child_dir  = trailingslashit( get_stylesheet_directory() );

			// Theme directory URIs.
			$this->parent_uri = trailingslashit( get_template_directory_uri()   );
			$this->child_uri  = trailingslashit( get_stylesheet_directory_uri() );

			// Sets the path to the core framework directory.
			if ( ! defined( 'FOX_DIR' ) )
				define( 'FOX_DIR', trailingslashit( $this->parent_dir . basename( dirname( __FILE__ ) ) ) );

			// Sets the path to the core framework directory URI.
			if ( ! defined( 'FOX_URI' ) )
				define( 'FOX_URI', trailingslashit( $this->parent_uri . basename( dirname( __FILE__ ) ) ) );

			// Set the directory properties.
			$this->dir = FOX_DIR;
			$this->uri = FOX_URI;
		}

		/**
		 * Loads the core framework files.
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function core() {

			// Load component files. - seems to be not necessary!
			//require_once( $this->dir . 'components/popular-posts.php'     );
			//require_once( $this->dir . 'components/ajax-categories.php'     );
			//require_once( $this->dir . 'components/featured-row-posts.php'     );
			//require_once( $this->dir . 'components/featured-slick-slider.php'     );

			// Load admin files.
			//if ( is_admin() )
				//require_once( $this->dir . 'admin/functions-admin.php' );
		}

		/**
		 * Adds the necessary setup actions for the theme.
		 *
		 * @since  4.0.0
		 * @access private
		 * @return void
		 */
		private function setup_actions() {
			add_action( 'after_setup_theme', array( $this, 'components'    ),  20 );
			add_action( 'after_setup_theme', array( $this, 'widgets'    ),  20 );
			add_action( 'after_setup_theme', array( $this, 'admin'    ),  20 );
		}


		/**
		 * Load myboutique theme components.  Themes must use `add_theme_support( $component )`
		 * to use a specific extension within the theme.
		 *
		 * @access public
		 * @return void
		 */
		public function components() {

			require_if_theme_supports( 'popular-posts', $this->dir . 'components/popular-posts.php' );
			require_if_theme_supports( 'ajax-categories', $this->dir . 'components/ajax-categories.php' );
			require_if_theme_supports( 'featured-row-posts', $this->dir . 'components/featured-row-posts.php' );
			require_if_theme_supports( 'featured-boxes', $this->dir . 'components/featured-boxes.php' );
			require_if_theme_supports( 'featured-slick-slider', $this->dir . 'components/featured-slick-slider.php' );

		}


		/**
		 * Load myboutique theme admin functionality.
		 *
		 * @access public
		 * @return void
		 */
		public function admin() {

			require_once( $this->dir . 'admin/admin-functions.php' );
			require_once( $this->dir . 'admin/nav-menu-boxes.php' );
			require_once( $this->dir . 'admin/elementor-library.php' );

		}

		/**
		 * Load myboutique theme widgets that are not part of the myboutique Plugin. 
		 * Themes must use `add_theme_support( $widget )` to add a widget.
		 *
		 * @access public
		 * @return void
		 */
		public function widgets() {

			require_if_theme_supports( 'youtube-widget', $this->dir . 'widgets/youtube-widget/youtube-widget.php' );
			require_if_theme_supports( 'profile-widget', $this->dir . 'widgets/profile-widget/profile-widget.php' );
			require_if_theme_supports( 'posts-widget', $this->dir . 'widgets/posts-widget/posts-widget.php' );
			require_if_theme_supports( 'thumbnails-widget', $this->dir . 'widgets/thumbnails-widget/thumbnails-widget.php' );
			require_if_theme_supports( 'category-index-widget', $this->dir . 'widgets/category-index-widget/category-index-widget.php' );
			require_if_theme_supports( 'social-media-widget', $this->dir . 'widgets/social-media-widget/social-media-widget.php' );
			require_if_theme_supports( 'featured-post-widget', $this->dir . 'widgets/featured-post-widget/featured-post-widget.php' );

			require_once( $this->dir . 'widgets/widget-options.php' );
		}
	}

	/**
	 * Gets the instance of the `Fox` class.  This function is useful for quickly grabbing data
	 * used throughout the framework.
	 *
	 * @access public
	 * @return object
	 */
	function fox() {
		return Fox::get_instance();
	}

	// Let's do this!
	fox();
}
